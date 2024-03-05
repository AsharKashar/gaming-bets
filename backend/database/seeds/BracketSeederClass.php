<?php

use App\Model\Team;
use App\Model\Tournament;
use App\Service\TournamentService;
use Illuminate\Database\Seeder;

class BracketSeederClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->isProduction()) {
            return;
        }
        $tournament = Tournament::find(1);
        if ($tournament) {
            TournamentService::seedDemoTeamsToTournament($tournament, 16);
//            Tournament::makeMatchesStructure($tournament);
        }
    }
}
