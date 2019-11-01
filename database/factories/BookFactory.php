<?php

use Faker\Generator as Faker;

$factory->define(\App\Book::class, function (Faker $faker) {
    return [
        'title_book' => $faker->sentence(2, true)
    ];
});
