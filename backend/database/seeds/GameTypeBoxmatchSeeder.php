<?php

use Illuminate\Database\Seeder;

class GameTypeBoxmatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('game_type_boxmatches')->insert([
            'description'   => '1 vs 1',
            'value'         => 1,
            'updated_at'    => now(),
            'created_at'    => now(),
        ]);

        DB::table('game_type_boxmatches')->insert([
            'description'   => '2 vs 2',
            'value'         => 2,
            'updated_at'    => now(),
            'created_at'    => now(),
        ]);

    }
}
