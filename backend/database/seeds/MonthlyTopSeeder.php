<?php

use App\Model\Leaderboard;
use Illuminate\Database\Seeder;

class MonthlyTopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Leaderboard::topThreeLeaderboardForSeeder();
    }
}
