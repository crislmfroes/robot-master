<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\State;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(State::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'className' => Str::ucfirst(Str::camel($faker->name()))
    ];
});
