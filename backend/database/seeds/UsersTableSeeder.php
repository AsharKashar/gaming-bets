<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run () {

        DB::table('users')->insert([
            'name'              => 'Admin Admin',
            'email'             => 'admin@black.com',
            'user_type'         => 'admin',
            'admin_type'        => 'owner',
            'email_verified_at' => now(),
            'password'          => Hash::make('secret'),
            'currency_id'       => 0,
            'image'             => "/black/img/default-avatar.png",
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        DB::table('users')->insert([
            'name'              => 'Test User',
            'email'             => 'user@black.com',
            'user_type'         => 'user',
            'email_verified_at' => now(),
            'password'          => Hash::make('secret'),
            'currency_id'       => 0,
            'created_at'        => now(),
            'updated_at'        => now(),
            'image'             => "/black/img/default-avatar.png",
        ]);



    }


}
