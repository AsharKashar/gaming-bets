<?php

namespace App\Http\Controllers;

use App\Model\BlogCategory;
use App\Model\BlogPost;
use App\Model\Locale;

/**
 * Class SlugsController
 * @package App\Http\Controllers
 */
class SlugsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/dynamic-slugs",
     *     tags={"slug"},
     *     @OA\Response(response="200", description="Return all available slugs")
     * ),
     *
     * @throws \Exception
     */
    public function getSlugsList()
    {
        $responseData = [];

        $blogCategorySlugs = BlogCategory::all()->pluck('slug')->toArray();
        $responseData = array_merge($responseData,$blogCategorySlugs);

        $blogPostSlugs = BlogPost::all()->pluck('full_post_slug')->toArray();
        $responseData = array_merge($responseData,$blogPostSlugs);

        return $this->successApiResponse($responseData);
    }

    /**
     * @OA\Get(
     *     path="/api/rss-info/{locale}",
     *     tags={"slug"},
     * @OA\Parameter(
     *     name="locale",
     *     in="path",
     *     description="Rss info locale",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Return all available posts rss info for specified locale")
     * ),
     *
     * @throws \Exception
     */
    public function getRssInfo($locale)
    {
        $locale = Locale::where('code',$locale)->first();

        if(!$locale) {
            return $this->resourceNotFound();
        }

        $blogPosts = BlogPost::all();

        $results = [];

        foreach ($blogPosts as $post) {
            $postLocale = $post->locales()->where('locale_id', $locale->id)->first();

            if(!$postLocale) {
                continue;
            }

            $item = [
                'id' => $post->id,
                'title' => $postLocale->name,
                'description' => $postLocale->description ?? $postLocale->meta_description,
                'link' => config('services.environment.url').'/'.$post->fullPostSlug,
                'date' => $postLocale->updated_at
            ];

            array_push($results, $item);
        }

        return $this->successApiResponse($results);
    }
}
