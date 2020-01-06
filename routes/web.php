<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Course;
use App\Handbook;
use App\Student;
use App\Subject;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (){
//    return Student::with('handbook')->find(1);
//    return Student::find(1)->handbook;
    return Handbook::find(1)->subjects;
});

Route::get('/test2', function (){
//    return Student::with('handbook')->find(1);
//    return Student::find(1)->handbook;
    return Handbook::find(1)->requiredSubjects;
});

Route::get('/test3', function (){
//    return Student::with('handbook')->find(1);
//    return Student::find(1)->handbook;
    return Handbook::find(1)->optionalSubjects;
});
