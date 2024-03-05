<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameModeRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_mode_rules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('game_mode_id')->unsigned();
            $table->bigInteger('locale_id')->unsigned();
            $table->json('rules');
            $table->timestamps();

            $table->foreign('game_mode_id')->references('id')->on('game_modes');
            $table->foreign('locale_id')->references('id')->on('locales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_mode_rules');
    }
}
