<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Disclaimer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Disclaimer::class, function (Faker $faker) {
    return [
        'content' => Str::random(100)
    ];
});
