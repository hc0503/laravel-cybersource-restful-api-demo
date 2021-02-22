<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slider;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Slider::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'image' => Str::random(10) . '.jpg',
        'url' => $faker->url,
        'status' => $faker->boolean
    ];
});
