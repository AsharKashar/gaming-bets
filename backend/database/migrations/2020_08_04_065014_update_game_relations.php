<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGameRelations extends Migration
{
    public function up()
    {
        Schema::table('game_to_game_type', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->change();
            $table->unsignedBigInteger('game_type_id')->change();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('game_type_id')->references('id')->on('game_types')->onDelete('cascade');
        });

        Schema::table('game_to_game_mode', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->change();
            $table->unsignedBigInteger('game_mode_id')->change();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('game_mode_id')->references('id')->on('game_modes')->onDelete('cascade');
        });

        Schema::table('game_to_game_platform', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->change();
            $table->unsignedBigInteger('game_platform_id')->change();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('game_platform_id')->references('id')->on('game_platforms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
