<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGameStatisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_game_statistic', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('game_id');
            $table->integer('total_points_earned')->default(0);
            $table->integer('total_bombs_earned')->default(0);
            $table->decimal('win_loss_record',3,1)->default(0);
            $table->decimal('win_ratio',3,1)->default(0);
            $table->timestamps();
        });

        DB::table('user_game_statistic')->insert(
            [
                [
                    'user_id' => 1,
                    'game_id' => 2,
                    'total_points_earned' => 300,
                    'total_bombs_earned' => 500,
                    'win_loss_record' => 38.6,
                    'win_ratio' => 39.7,
                ]
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_game_statistic');
    }
}
