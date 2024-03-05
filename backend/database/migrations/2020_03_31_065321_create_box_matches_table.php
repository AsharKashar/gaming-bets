<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('match_id')->nullable();;
            $table->string('team_id');
            $table->string('bid_amount');
            $table->string('game_type');
            $table->string('platform');
            $table->string('region');
            $table->string('user_id')->nullable();
            $table->string('username')->nullable();
            $table->string('result')->nullable();
            $table->string('time');
            $table->string('proof')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('box_matches');
    }
}
