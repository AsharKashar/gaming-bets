<?php

use App\Model\BlogPost;
use Illuminate\Database\Migrations\Migration;

class SetExistPostsAsPublished extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $posts = BlogPost::all();

        foreach ($posts as $post) {
            $post->status = BlogPost::STATUSES['published'];
            $post->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $posts = BlogPost::all();

        foreach ($posts as $post) {
            $post->status = BlogPost::STATUSES['draft'];
            $post->save();
        }
    }
}
