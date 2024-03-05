<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameModeGameTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_mode_game_type', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('game_mode_id')->unsigned();
            $table->bigInteger('game_type_id')->unsigned();

            $table->foreign('game_mode_id')->references('id')->on('game_modes')->cascadeOnDelete();
            $table->foreign('game_type_id')->references('id')->on('game_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_mode_game_type');
    }
}
