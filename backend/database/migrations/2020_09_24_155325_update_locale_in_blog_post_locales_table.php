<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Model\Locale;
use \App\Model\BlogPostLocale;

class UpdateLocaleInBlogPostLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', array('--class' => 'localeSeederClass'));

        Schema::table('blog_post_locales', function (Blueprint $table) {
            $table->dropForeign(['blog_post_id']);
        });
        Schema::table('blog_post_locales', function (Blueprint $table) {
            $table->dropUnique(['blog_post_id', 'locale']);
        });


      Schema::table('blog_post_locales', function (Blueprint $table) {
            $table->unsignedBigInteger('locale_id')->after('blog_post_id');
        });

        $localeDefaultId = Locale::firstWhere('code', 'en')->id;

        BlogPostLocale::all()->each(function($blogPostLocale)  use ($localeDefaultId) {
            $locale = Locale::firstWhere('code', $blogPostLocale->locale);
            $blogPostLocale->update([
                'locale_id' => optional($locale)->id ?? $localeDefaultId,
            ]);
        });

        Schema::table('blog_post_locales', function (Blueprint $table) {
            $table->foreign('locale_id')->references('id')->on('locales');
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');
        });

        Schema::table('blog_post_locales', function (Blueprint $table) {
            $table->dropColumn('locale');

            $table->unique(['blog_post_id', 'locale_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_post_locales', function (Blueprint $table) {
            $table->string('locale')->after('blog_post_id');

            $table->dropForeign(['blog_post_id']);
            $table->dropForeign(['locale_id']);
        });

        Schema::table('blog_post_locales', function (Blueprint $table) {
            $table->dropUnique(['blog_post_id', 'locale_id']);
        });

        BlogPostLocale::all()->each(function($blogPostLocale) {
            $locale = Locale::find($blogPostLocale->locale_id);
            $blogPostLocale->update([
                'locale' => $locale->code,
            ]);
        });

        Schema::table('blog_post_locales', function (Blueprint $table) {
                $table->foreign('blog_post_id')->references('id')->on('blog_posts');
        });

        Schema::table('blog_post_locales', function (Blueprint $table) {
            $table->dropColumn('locale_id');
            $table->unique(['blog_post_id', 'locale']);
        });
    }
}
