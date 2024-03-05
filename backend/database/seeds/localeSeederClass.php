<?php

use Illuminate\Database\Seeder;
use app\Model\Game;
class localeSeederClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('locales')->insert([
            'name'       => 'English',
            'code'      => 'en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('locales')->insert([
            'name'       => 'Spanish',
            'code'       => 'es',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
