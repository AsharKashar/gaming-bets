<?php

use Illuminate\Database\Seeder;

class PackaegesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('packages')->insert([
            'name' => 'Novice',
            'stripe_plan' => 'plan_H6I3JfBRpPzsT8',
            'stripe_quantity' => 5,
            'boxfight_quantity' => 15,
            'daily_allowed' => 2.5,
            'weekly_allowed' => 10,
            'monthly_allowed' => 10,
            'daily_save' => 22,
            'money_win_chance' => 35,
            'wagers' => 25,
            'pay' => 95,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('packages')->insert([
            'name' => 'Elite',
            'stripe_plan' => 'plan_H6I3JfBRpPzsT8',
            'stripe_quantity' => 10,
            'boxfight_quantity' => 50,
            'daily_allowed' => 5,
            'weekly_allowed' => 15,
            'monthly_allowed' => 15,
            'daily_save' => 22,
            'money_win_chance' => 35,
            'wagers' => 25,
            'pay' => 179,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('packages')->insert([
            'name' => 'God',
            'stripe_plan' => 'plan_H6I3JfBRpPzsT8',
            'stripe_quantity' => 15,
            'boxfight_quantity' => 9999,
            'daily_allowed' => 7.5,
            'weekly_allowed' => 20,
            'monthly_allowed' => 20,
            'daily_save' => 22,
            'money_win_chance' => 35,
            'wagers' => 25,
            'pay' => 239,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
