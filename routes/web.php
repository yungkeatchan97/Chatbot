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
use App\Subject;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/test', function (){
//    $subject_ids = array();
//    $subjects = Subject::all('id');
//    foreach($subjects as $subject){
//        array_push($subject_ids, $subject->id);
//    }
//    return $subject_ids;
//});
