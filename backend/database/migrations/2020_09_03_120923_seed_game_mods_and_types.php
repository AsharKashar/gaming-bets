<?php

use App\Model\Game;
use App\Model\TeamSize;
use Illuminate\Database\Migrations\Migration;

class SeedGameModsAndTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        TeamSize::create([
            'name' => '3x3',
            'size' => 3
        ]);
        TeamSize::create([
            'name' => '4x4',
            'size' => 4
        ]);
        //Artisan::call('db:seed', array('--class' => 'GamesSeeder'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Game::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
