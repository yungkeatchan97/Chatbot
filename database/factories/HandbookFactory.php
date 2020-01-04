<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Handbook;
use Faker\Generator as Faker;

$factory->define(Handbook::class, function (Faker $faker) {
    $codes = array();
    $courses = Course::all('code');
    foreach($courses as $course){
        array_push($codes, $course->code);
    }

    return [
        'year' => $faker->numberBetween(2015,2020),
        'total_credit_hour' => $faker->numberBetween(120, 130),
        'course_code' => $faker->randomElement($codes)
    ];
});
