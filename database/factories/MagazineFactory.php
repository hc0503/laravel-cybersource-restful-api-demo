<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Frequency;
use App\Models\Genre;
use App\Models\Magazine;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Magazine::class, function (Faker $faker) {
    return [
        'genre_id' => Genre::all(['id'])->random(),
        'frequency_id' => Frequency::all(['id'])->random(),
        'title' => $faker->sentence,
        'description' => $faker->text,
        'cover_image' => Str::random(10) . '.jpg'
    ];
});
