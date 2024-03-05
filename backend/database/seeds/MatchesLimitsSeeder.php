<?php

use App\Model\MatchLimit;
use Illuminate\Database\Seeder;

class MatchesLimitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limits = [
            [0,0],
            [25,110],
            [15,50],
            [20,35],
            [20,50],
            [10,70],
            [30,40],
            [20,40],
            [10,45],
            [10,25],
            [10,20],
            [10,10],
        ];

        foreach ($limits as $limit) {
            MatchLimit::create([
                'min' => $limit[0],
                'max' => $limit[1],
            ]);
        }
    }
}
