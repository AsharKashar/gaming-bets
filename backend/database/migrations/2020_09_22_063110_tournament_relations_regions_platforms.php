<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TournamentRelationsRegionsPlatforms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('tournament_to_game_platform', function (Blueprint $table) {
            $table->unsignedBigInteger('tournament_id')->change();
            $table->unsignedBigInteger('game_platform_id')->change();

            $table->foreign('game_platform_id')->references('id')->on('game_platforms')->onDelete('cascade');
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
        });

        Schema::table('tournament_to_regions', function (Blueprint $table) {
            $table->unsignedBigInteger('tournament_id')->change();
            $table->unsignedBigInteger('region_id')->change();

            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('tournament_to_game_platform', function (Blueprint $table) {
            $table->dropForeign(['game_platform_id']);
            $table->dropForeign(['tournament_id']);
        });

        Schema::table('tournament_to_regions', function (Blueprint $table) {
            $table->dropForeign(['tournament_id']);
            $table->dropForeign(['region_id']);
        });

        Schema::enableForeignKeyConstraints();
    }
}
