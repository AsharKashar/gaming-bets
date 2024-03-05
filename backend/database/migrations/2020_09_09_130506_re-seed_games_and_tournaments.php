<?php

use App\Model\Game;
use App\Model\GameMode;
use App\Model\GameType;
use App\Model\Tournament;
use App\Model\TournamentPrize;
use App\Model\TournamentSize;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReSeedGamesAndTournaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Tournament::truncate();
        Game::truncate();
        GameMode::truncate();
        GameType::truncate();
        TournamentSize::truncate();
        TournamentPrize::truncate();
        Schema::enableForeignKeyConstraints();

//        Artisan::call('db:seed', array('--class' => 'GamesSeeder'));
//        Artisan::call('db:seed', array('--class' => 'TournamentsSeeder'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Tournament::truncate();
        Game::truncate();
        GameMode::truncate();
        GameType::truncate();
        TournamentSize::truncate();
        TournamentPrize::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
