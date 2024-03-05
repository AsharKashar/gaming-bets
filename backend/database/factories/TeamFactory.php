<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Team;
use App\Model\TeamSize;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        "name"=>$faker->name,
        "team_size_id"=>TeamSize::first()->id,
        "token"=>$faker->sentence,
        "game_id"=>1
    ];
});
