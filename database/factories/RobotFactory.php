<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Robot;
use Faker\Generator as Faker;

$factory->define(Robot::class, function (Faker $faker) {
    return [
        'name' => $faker->name()
    ];
});
