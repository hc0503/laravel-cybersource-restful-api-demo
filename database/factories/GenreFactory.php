<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Genre;

$factory->define(Genre::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle
    ];
});
