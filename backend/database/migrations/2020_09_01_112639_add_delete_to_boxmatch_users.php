<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteToBoxmatchUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boxmatch_users', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('user_awards', function (Blueprint $table) {
            //
            $table->dropColumn('box_game_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boxmatch_users', function (Blueprint $table) {
            //
            $table->dropColumn('deleted_at');
        });

        Schema::table('user_awards', function (Blueprint $table) {
            //
            $table->integer('box_game_id');
        });
    }
}
