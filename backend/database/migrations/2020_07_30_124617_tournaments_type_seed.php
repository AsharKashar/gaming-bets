<?php

use App\Model\TournamentType;
use Illuminate\Database\Migrations\Migration;

class TournamentsTypeSeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        TournamentType::create([
            'name' => 'Player Based'
        ]);

        TournamentType::create([
            'name' => 'Team Based'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        TournamentType::truncate();
    }
}
