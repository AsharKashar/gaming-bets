<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteToFaqCatagories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faq_catagories', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('faq_ask_questions', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('faq_questions', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('locales', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('game_type_boxmatches', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('box_match_results', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faq_catagories', function (Blueprint $table) {
            //
            $table->dropColumn('deleted_at');
        });

        Schema::table('faq_ask_questions', function (Blueprint $table) {
            //
            $table->dropColumn('deleted_at');
        });

        Schema::table('faq_questions', function (Blueprint $table) {
            //
            $table->dropColumn('deleted_at');
        });

        Schema::table('locales', function (Blueprint $table) {
            //
            $table->dropColumn('deleted_at');
        });

        Schema::table('game_type_boxmatches', function (Blueprint $table) {
            //
            $table->dropColumn('deleted_at');
        });

        Schema::table('box_match_results', function (Blueprint $table) {
            //
            $table->dropColumn('deleted_at');
        });
    }
}
