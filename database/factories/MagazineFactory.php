<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Frequency;
use App\Models\Genre;
use App\Models\Magazine;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Magazine::class, function (Faker $faker) {
    return [
        'user_id' => User::all(['id'])->random(),
        'genre_id' => Genre::all(['id'])->random(),
        'frequency_id' => Frequency::all(['id'])->random(),
        'title' => $faker->sentence,
        'description' => $faker->text,
        'cover_image' => Str::random(10) . '.jpg'
    ];
});
