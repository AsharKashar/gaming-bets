<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedGamesAndTournaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('games')->delete();
        DB::table('tournaments')->delete();

        //Artisan::call('db:seed', array('--class' => 'GamesSeeder'));
        //Artisan::call('db:seed', array('--class' => 'TournamentsSeeder'));
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
