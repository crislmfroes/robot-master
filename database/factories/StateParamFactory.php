<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StateParam;
use Faker\Generator as Faker;

$factory->define(StateParam::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'value' => $faker->name()
    ];
});
