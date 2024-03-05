<?php

use Illuminate\Database\Seeder;

class BoxMatchRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rulesCat1 = [
                    'No more than 4 players per match allowed.',
                    'If all the users have not joined the match before the time of starting. Match gets cancelled.',
                    'In case of a dispute, Admin will take decision based on evidence.',
                    'Award decision will be made within 2 hours of the startin time of the match.',
                    'All matches are subject to terms and conditions.',
            ];

        $rulesCat2 = [
                    'This is rule number 1',
                    'This is rule number 2',
                    'This is rule number 3',
                    'This is rule number 4',
                    'This is rule number 5',
            ];
        //
        DB::table('box_match_rules')->insert([
            'game_id'       => '1',
            'title'         => 'Title Number 1',
            'rule'      => json_encode($rulesCat1),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('box_match_rules')->insert([
            'game_id'       => '1',
            'title'         => 'Title Number 2',
            'rule'      => json_encode($rulesCat2),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        }

}
