<?php

use App\Model\Locale;
use Illuminate\Database\Seeder;

class FaqCatagorySeederClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faq_catagories')->insert([
            'catagory_name'      => 'Gamers',
            'locale_id' => Locale::where('code','en')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faq_catagories')->insert([
            'catagory_name'      => 'Money withdrawals',
            'locale_id' => Locale::where('code','en')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faq_catagories')->insert([
            'catagory_name'      => 'About Banger Games',
            'locale_id' => Locale::where('code','en')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faq_catagories')->insert([
            'catagory_name'      => 'Managing your account',
            'locale_id' => Locale::where('code','en')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('faq_catagories')->insert([
            'catagory_name'      => 'Jugadores',
            'locale_id' => Locale::where('code','es')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faq_catagories')->insert([
            'catagory_name'      => 'Retiros de dinero',
            'locale_id' => Locale::where('code','es')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faq_catagories')->insert([
            'catagory_name'      => 'Acerca de Banger Games',
            'locale_id' => Locale::where('code','es')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faq_catagories')->insert([
            'catagory_name'      => 'Administrando su cuenta',
            'locale_id' => Locale::where('code','es')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
