<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ContactUs;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ContactUs::class, function (Faker $faker) {
    return [
        'content' => Str::random(100)
    ];
});
