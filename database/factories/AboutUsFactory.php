<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AboutUs;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(AboutUs::class, function (Faker $faker) {
    return [
        'content' => Str::random(100)
    ];
});
