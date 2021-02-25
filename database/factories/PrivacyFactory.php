<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Privacy;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Privacy::class, function (Faker $faker) {
    return [
        'content' => Str::random(100)
    ];
});
