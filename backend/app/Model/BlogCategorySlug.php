<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BlogCategorySlug
 *
 * @property int $id
 * @property int $blog_category_id
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\BlogCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategorySlug newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategorySlug newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategorySlug query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategorySlug whereBlogCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategorySlug whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategorySlug whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategorySlug whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogCategorySlug whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlogCategorySlug extends Model
{
    protected $fillable = [
        'blog_category_id',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
