<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\App::class, function (Faker $faker) {
    return [
        'name' => $faker->word ,
        'description' => $faker->text($maxNbChars = 200) ,
        'icon' => $faker->imageUrl($width = 640, $height = 480) ,
        'creator' => $faker->name ,
        'created_at' => now(),
    ];
});
