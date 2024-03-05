<?php

namespace App\Model;

use App;
use App\Service\LocaleServices;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\{
    Builder
};

/**
 * App\Model\BlogPost
 *
 * @property int $id
 * @property string $name
 * @property int $main_category_id
 * @property string $status
 * @property string|null $description
 * @property string|null $preview_image_key
 * @property string|null $body
 * @property string|null $meta_description
 * @property string|null $meta_title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BlogCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read string $full_post_slug
 * @property-read string $preview_image_url
 * @property-read mixed|null $slug
 * @property-read \App\Model\BlogCategory|null $mainCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BlogPostSlug[] $slugs
 * @property-read int|null $slugs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereMainCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost wherePreviewImageKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPost whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $slug_for_sitemap
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BlogPostLocale[] $locales
 * @property-read int|null $locales_count
 * @property-read array $content_detail
 */
class BlogPost extends Model
{
    protected $fillable = [
        'status',
        'preview_image_key',
        'main_category_id',
    ];

    protected $appends = [
        'preview_image_url',
        'full_post_slug',
        'slug',
        'content_detail'
    ];

    public const STATUSES = [
        'draft' => 'draft',
        'published' => 'published',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_blog_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainCategory()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'main_category_id');
    }

    public function slugs()
    {
        return $this->hasMany(BlogPostSlug::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locales()
    {
        return $this->hasMany(BlogPostLocale::class);
    }

    /**
     * @return string
     */
    public function getPreviewImageUrlAttribute()
    {
        return $this->preview_image_key ? config('filesystems.disks.s3.url').$this->preview_image_key : '';
    }

    /**
     * @return string
     */
    public function getFullPostSlugAttribute()
    {
        $categorySlug = $this->mainCategory->slug;
        $postSlug = $this->slug;

        return "$categorySlug/$postSlug";
    }

    public function getSlugForSitemapAttribute()
    {
        return [
            'categoryId' => $this->mainCategory->slug,
            'postId' => $this->slug
        ];
    }

    /**
     * @return mixed|null
     */
    public function getSlugAttribute()
    {
        $slug = $this->slugs()->orderBy('updated_at', 'desc')->first();

        if ($slug) {
            return $slug->slug;
        }

        return null;
    }

    /**
     * @return array
     */
    public function getContentDetailAttribute()
    {
        $locale = LocaleServices::getFirstLocaleToCollection($this->locales()->get());
        return  [
            'name' => optional($locale)->name,
            'body' => optional($locale)->body,
            'description' => optional($locale)->description,
            'meta_title' => optional($locale)->meta_title,
            'meta_description' => optional($locale)->meta_description,
        ];
    }

    /**
     * @param $postSlug
     * @return mixed
     */
    public static function getPostBySlug($postSlug)
    {
        $instance = new static;

        return $instance::whereHas(
            'slugs',
            function (Builder $q) use ($postSlug) {
                $q->where(['slug' => $postSlug]);
            }
        )->first();
    }

    /**
     * @param $slugValue
     */
    public function applySlug($slugValue)
    {
        $slug = BlogPostSlug::with('post')->firstWhere('slug', $slugValue);
        if ($slug && optional($slug->post)->id === $this->id) {
            $slug->touch();
        } elseif ($slug) {
            $this->slugs()->save(new BlogPostSlug([
                'blog_post_id' => $this->id,
                'slug' => str_slug($slugValue) . '__' . Carbon::now()->toDateString()
            ]));
        } else {
            $this->slugs()->save(new BlogPostSlug([
                'blog_post_id' => $this->id,
                'slug' => str_slug($slugValue)
            ]));
        }
    }
}
