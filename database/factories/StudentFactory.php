<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $codes = array();
    $courses = Course::all('code');
    foreach($courses as $course){
        array_push($codes, $course->code);
    }

    return [
        'matric_no' => $faker->unique()->randomNumber(6),
        'name' => $faker->name,
        'starting_year' => $faker->year,
        'course_code' => $faker->randomElement($codes)
    ];
});
