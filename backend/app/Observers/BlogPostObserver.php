<?php

namespace App\Observers;

use App\Model\BlogPost;
use Illuminate\Support\Facades\Storage;
use Log;

/**
 * Class BlogPostObserver
 * @package App\Observers
 */
class BlogPostObserver
{
    /**
     * @param BlogPost $blogPost
     */
    public function deleted(BlogPost $blogPost)
    {
        Storage::disk('s3')->deleteDirectory("blog_post/$blogPost->id");
    }
}
