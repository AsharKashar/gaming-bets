<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BlogPostSlug
 *
 * @property int $id
 * @property int $blog_post_id
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\BlogPost $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostSlug newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostSlug newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostSlug query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostSlug whereBlogPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostSlug whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostSlug whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostSlug whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BlogPostSlug whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlogPostSlug extends Model
{
    protected $fillable = [
        'blog_post_id',
        'slug',
    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id');
    }
}
