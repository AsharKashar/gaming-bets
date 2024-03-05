<?php

use App\Model\UserLevel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('points');
            $table->timestamps();
        });

        $levels = [
            0,
            1000,
            3000,
            7000,
            15000,
            31000,
            55000,
            91000,
            145000,
            226000,
            347000,
            499000,
            689219,
            926523,
            1223154,
            1593943,
            2011080,
            2480359,
            3008299,
            3602230
        ];

        foreach ($levels as $key => $points) {
            UserLevel::create([
                'name' => 'Level '.($key),
                'points' => $points
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_levels');
    }
}
