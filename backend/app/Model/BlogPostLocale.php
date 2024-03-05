<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BlogPostLocale
 *
 * @property int $id
 * @property int $blog_post_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereBlogPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $locale_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostLocale whereLocaleId($value)
 */
class BlogPostLocale extends Model
{
    protected $fillable = [
        'locale_id',
        'locale',
        'name',
        'description',
        'meta_description',
        'meta_title',
        'body',
        'blog_post_id'
    ];
}
