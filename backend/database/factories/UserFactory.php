<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'user_type'         => 'user',
        'email'             => $faker->unique()->safeEmail,
        'password'          => Hash::make('secret'),
        'currency_id'       => 0,
        'email_verified_at' => now(),
        'created_at'        => now(),
        'updated_at'        => now(),
        'remember_token' => '',
        'image'             => "/black/img/default-avatar.png",
    ];
});
