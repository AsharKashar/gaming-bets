<?php

use Illuminate\Database\Seeder;

class AweberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                'key' => 'aweber',
                'value' => json_encode(
                    [
                        'accessToken' => '6XZT32w7rYJzCWuMNwIIwzYw2PvxuxRW',
                        'refreshToken' => '35351r9eQ4XdJB1InKR485skTpLlUWp2',
                    ]
                ),
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
