<?php

use Faker\Generator as Faker;
use Dewsign\BeforeAfterRepeater\BeforeAfter;

$factory->define(BeforeAfter::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'subtitle' => $faker->sentence(6),
        'original_image' => $faker->imageUrl($width = 640, $height = 480, 'business'),
        'original_alt' => $faker->word,
        'overlay_image' => $faker->imageUrl($width = 640, $height = 480, 'business'),
        'overlay_alt' => $faker->word,
    ];
});