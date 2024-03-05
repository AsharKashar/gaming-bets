<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRedundantTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('game_to_game_mode');
        Schema::dropIfExists('game_mode_game_type');
        Schema::disableForeignKeyConstraints();

        Schema::table('game_modes', function (Blueprint $table) {
            $table->dropUnique('game_modes_name_unique');
            $table->unsignedBigInteger('game_id')->after('name');
            $table->foreign('game_id')->references('id')->on('games');
        });

        Schema::table('game_types', function (Blueprint $table) {
            $table->dropUnique('game_types_name_unique');
            $table->unsignedBigInteger('game_mode_id')->after('name');
            $table->foreign('game_mode_id')->references('id')->on('game_modes');
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
        Schema::table('game_modes', function (Blueprint $table) {
            if (Schema::hasColumn('game_modes', 'game_id')) {
                $table->dropForeign('game_modes_game_id_foreign');
                $table->dropColumn('game_id');
            }
        });

        Schema::table('game_types', function (Blueprint $table) {
            if (Schema::hasColumn('game_types', 'game_mode_id')) {
                $table->dropForeign('game_types_game_mode_id_foreign');
                $table->dropColumn('game_mode_id');
            }
        });
        Schema::enableForeignKeyConstraints();
    }
}
