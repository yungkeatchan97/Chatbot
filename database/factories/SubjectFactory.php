<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->bothify('???####'),
        'name' => $faker->text(5),
        'credit_hour' => $faker->numberBetween(2, 4)
    ];
});
