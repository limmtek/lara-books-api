<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'year_of_writing' => \Faker\Provider\DateTime::year(),
        'number_of_pages' => mt_rand(200, 1600),
    ];
});
