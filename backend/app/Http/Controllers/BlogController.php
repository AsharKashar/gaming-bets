<?php

namespace App\Http\Controllers;

use App\Model\BlogCategory;
use App\Model\BlogPost;
use App\Service\AweberService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\{
    Builder
};

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/blog/categories",
     *     tags={"blog"},
     *     @OA\Response(response="200", description="Blog categories list")
     * )
     */
    public function getMainCategories()
    {
        $categories = BlogCategory::whereNull('parent_id')->get()->toArray();

        return $this->successApiResponse($categories);
    }

    /**
     * @OA\Get(
     *     path="/api/blog/{category_slug}",
     *     tags={"blog"},
     * @OA\Parameter(
     *     name="category_slug",
     *     in="path",
     *     description="Category slug",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Blog category details")
     * )
     */
    public function getCategoryDetails(Request $request)
    {
        $categorySlug = $request->route('category_slug');
        $category = BlogCategory::getCategoryBySlug($categorySlug);

        if (!$category) {
            return $this->resourceNotFound();
        }

        if ($category->slug === $categorySlug) {
            return $this->successApiResponse($category->toArray());
        }

        return $this->redirectApiResponse("/$category->slug");
    }

    /**
     * @OA\Get(
     *     path="/api/blog/{category_slug}/{post_slug}",
     *     tags={"blog"},
     * @OA\Parameter(
     *     name="post_slug",
     *     in="path",
     *     description="Post slug",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="category_slug",
     *     in="path",
     *     description="Category slug",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Blog post content")
     * )
     */
    public function getBlogPost(Request $request)
    {
        $categorySlug = $request->route('category_slug');
        $blogCategory = BlogCategory::getCategoryBySlug($categorySlug);

        if (!$blogCategory) {
            return $this->resourceNotFound();
        }
        $postSlug = $request->route('post_slug');
        $blogPost = BlogPost::getPostBySlug($postSlug);
        if (!$blogPost || $blogPost->status !== BlogPost::STATUSES['published']) {
            return $this->resourceNotFound();
        }

        if ($blogPost->slug === $postSlug && $blogCategory->slug === $categorySlug) {
            return $this->successApiResponse($blogPost);
        }

        return $this->redirectApiResponse("/$blogPost->full_post_slug");
    }

    /**
     * @OA\Get(
     *     path="/preview/news/{blog_post}",
     *     tags={"blog_post"},
     * @OA\Parameter(
     *     name="blog_post",
     *     in="path",
     *     description="Blog post",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Blog post content")
     * )
     */
    public function getBlogPostPreview(BlogPost $blogPost, Request $request)
    {
        if (!$blogPost) {
            return $this->resourceNotFound();
        }

        return $this->successApiResponse($blogPost);
    }

    /**
     * @OA\Get(
     *     path="/api/blog/posts",
     *     tags={"blog"},
     * @OA\Parameter(
     *     name="category_slug",
     *     in="query",
     *     description="Post category slug",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="order_by",
     *     in="query",
     *     description="Order post by column",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="order_direction",
     *     in="query",
     *     description="Posts order direction",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="Posts per page default(10)",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Posts current page default(1)",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="random",
     *     in="query",
     *     description="Get random posts",
     *     required=false,
     * ),
     * @OA\Parameter(
     *          name="subcategories[]",
     *          description="Show posts from subcategories list",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="string"),
     *          )
     *      ),
     * @OA\Parameter(
     *          name="exclude[]",
     *          description="Exclude some posts by id",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="number"),
     *          )
     *      ),
     * @OA\Response(response="200", description="Posts list"),
     * )
     */
    public function getPosts(Request $request)
    {
        $categorySlug = $request->input('category_slug');
        $subcategories = $request->input('subcategories');
        $exclude = $request->input('exclude');
        $random = $request->input('random');
        $orderBy = $request->input('order_by');
        $orderDirection = $request->input('order_direction') ?? 'desc';
        $perPage = $request->input('per_page');

        $query = BlogPost::query()->where('status', BlogPost::STATUSES['published']);

        if ($subcategories) {
            $query->whereHas(
                'categories.slugs',
                function (Builder $q) use ($subcategories) {
                    $q->whereIn('slug', $subcategories);
                }
            );
        }

        if ($categorySlug) {
            $blogCategory = BlogCategory::getCategoryBySlug($categorySlug);

            if ($blogCategory) {
                $currentCategoryId = $blogCategory->id;
                $query->where(function($q) use($blogCategory, $currentCategoryId) {
                    $q->where('main_category_id', $currentCategoryId)
                        ->orWhereHas(
                            'categories',
                            function (Builder $q) use ($currentCategoryId) {
                                $q->where(['blog_category_id' => $currentCategoryId]);
                            }
                        )->where('status', BlogPost::STATUSES['published']);
                });
            } else {
                return $this->resourceNotFound();
            }
        }

        if ($orderBy) {
            $query->orderBy($orderBy, $orderDirection);
        }

        if ($random) {
            $query->inRandomOrder();
        }

        if ($exclude) {
            $query->whereNotIn('blog_posts.id', $exclude);
        }

        return $this->successApiResponse($query->paginate($perPage));
    }

    /**
     * @OA\Post(
     *     path="/api/blog/subscribe",
     *     tags={"blog"},
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="Email to subscribe",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Subscribe email address to news")
     * ),
     *
     * @throws \Exception
     */
    public function subscribeEmail(Request $request)
    {
        $email = $request->input('email');

        if (!$email) {
            return $this->internalErrorApiResponse();
        }

        $aweberService = new AweberService();
        $aweberService->formSubscribe('blog-page', $email);

        return $this->successApiResponse();
    }

    /**
     * @OA\Post(
     *     path="/api/blog/available-slugs/{type}",
     *     tags={"blog"},
     * @OA\Parameter(
     *     name="type",
     *     in="path",
     *     description="Slugs type [blog-category, blog-post]",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Return all available slugs related to blog")
     * ),
     *
     * @throws \Exception
     */
    public function getSlugsList($type)
    {
        $responseData = [];

        switch ($type) {
            case 'blog-category':
            {
                $slugs = BlogCategory::all()->pluck('slug')->toArray();
                $responseData = array_values(
                    array_filter(
                        $slugs,
                        function ($item) {
                            return $item;
                        }
                    )
                );
                break;
            }

            case 'blog-post':
            {
                $slugs = BlogPost::all()->pluck('slug_for_sitemap')->toArray();
                $responseData = array_values(
                    array_filter(
                        $slugs,
                        function ($item) {
                            return $item['categoryId'] && $item['postId'];
                        }
                    )
                );
                break;
            }

            default:
            {
                $responseData = [];
            }
        }

        return $this->successApiResponse($responseData);
    }
}
