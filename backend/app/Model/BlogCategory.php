<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\{
    Builder
};

/**
 * App\Model\BlogCategory
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string|null $description
 * @property string|null $preview_image_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $preview_image_url
 * @property-read mixed|null $slug
 * @property-read \App\Model\BlogCategory|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BlogCategorySlug[] $slugs
 * @property-read int|null $slugs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BlogCategory[] $subcategories
 * @property-read int|null $subcategories_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory wherePreviewImageKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlogCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'preview_image_key',
        'parent_id'
    ];

    protected $appends = [
        'preview_image_url',
        'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Model\BlogCategory', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany('App\Model\BlogCategory', 'parent_id');
    }


    /**
     * @return mixed
     */
    public function posts()
    {
        $currentCategoryId = $this->id;

        return BlogPost::where('main_category_id', $currentCategoryId)->orWhereHas(
            'categories',
            function (Builder $q) use ($currentCategoryId) {
                $q->where(['blog_category_id' => $currentCategoryId]);
            }
        );
    }

    public function slugs()
    {
        return $this->hasMany(BlogCategorySlug::class);
    }

    /**
     * @return string
     */
    public function getPreviewImageUrlAttribute()
    {
        return config('filesystems.disks.s3.url').$this->preview_image_key;
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
     * @param $categorySlug
     * @return mixed
     */
    public static function getCategoryBySlug($categorySlug)
    {
        $instance = new static;

        return $instance::whereHas(
            'slugs',
            function (Builder $q) use ($categorySlug) {
                $q->where(['slug' => $categorySlug]);
            }
        )->with('subcategories')->first();
    }

    /**
     * @param $slugValue
     */
    public function applySlug($slugValue)
    {
        $slugExist = BlogCategorySlug::where('slug', $slugValue)->first();
        $slugs = $this->slugs()->pluck('slug')->toArray();

        $slugAlreadyApplied = in_array(str_slug($slugValue), $slugs);

        if ($slugExist && $slugAlreadyApplied) {
            $slugExist->touch();
        } elseif (!$slugExist) {
            $this->slugs()->save(
                new BlogCategorySlug(
                    [
                        'blog_category_id' => $this->id,
                        'slug' => str_slug($slugValue)
                    ]
                )
            );
        }
    }
}
