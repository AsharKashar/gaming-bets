<?php

use App\Model\Tournament;
use App\Model\TournamentPrize;
use Illuminate\Database\Migrations\Migration;

class DemoPrizesSeed extends Migration
{
    private function generateRandomPrize ($tournament) {
        $prizesNumber = rand(1,5);

        for ($i = 1; $i <= $prizesNumber; $i++) {
            TournamentPrize::create([
                'point' => rand(1, 10),
                'position' => $i,
                'prize' => rand(1, 50),
                'tournament_id' => $tournament->id
            ]);
        }
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $tournaments = Tournament::all();

       foreach ($tournaments as $tournament) {
           $this->generateRandomPrize($tournament);
       }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        TournamentPrize::truncate();
    }
}
