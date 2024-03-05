<?php

use App\Model\BlogPost;
use App\Model\BlogPostLocale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveBlogPostDataToBlogPostLocaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->renameColumn('description', 'description_old');
            $table->renameColumn('name', 'name_old');
            $table->renameColumn('body', 'body_old');
            $table->renameColumn('meta_title', 'meta_title_old');
            $table->renameColumn('meta_description', 'meta_description_old');
        });

        $blogPosts = BlogPost::all();

        foreach ($blogPosts as $blogPost) {
            $blogPostLocale = new BlogPostLocale([
                'description' => $blogPost->description_old,
                'name' => $blogPost->name_old,
                'body' => $blogPost->body_old,
                'meta_title' => $blogPost->meta_title_old,
                'meta_description' => $blogPost->meta_description_old,
                'blog_post_id' => $blogPost->id,
                'locale' => 'en'
            ]);
            $blogPostLocale->save();
        }


        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('description_old', 'name_old', 'body_old', 'meta_title_old', 'meta_description_old');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->longText('description')->nullable();
            $table->string('name');
            $table->longText('body');
            $table->longText('meta_title');
            $table->longText('meta_description');
        });

        $locales = BlogPostLocale::all();

        foreach ($locales as $locale) {
            $blogPost = BlogPost::find($locale->blog_post_id);
            if ($blogPost) {
                $blogPost->update([
                    'description' => $locale->description,
                    'name' => $locale->name,
                    'body' => $locale->body,
                    'meta_title' => $locale->meta_title,
                    'meta_description' => $locale->meta_description,
                ]);
            }
        }

        BlogPostLocale::truncate();
    }
}
