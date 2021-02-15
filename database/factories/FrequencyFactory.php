<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Frequency;
use Faker\Generator as Faker;

$factory->define(Frequency::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle
    ];
});
