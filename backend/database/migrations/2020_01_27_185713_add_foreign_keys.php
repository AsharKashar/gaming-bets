<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::table("tournaments", function (Blueprint $table) {
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });

        Schema::table("tournament_results", function (Blueprint $table) {
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
        });

        Schema::table("tournament_rules", function (Blueprint $table) {
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
        });

        Schema::table("tournament_user", function (Blueprint $table) {
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        //
    }


}
