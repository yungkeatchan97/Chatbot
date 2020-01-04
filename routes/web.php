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
use App\Student;
use App\Subject;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/test', function (){
//    return Student::with('handbook')->find(1);
////    return Student::find(1)->handbook;
//});
