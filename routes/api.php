<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResources([
    'students' => 'StudentController',
    'courses' => 'CourseController',
    'handbooks' => 'HandbookController',
    'subjects' => 'SubjectController',
]);

Route::get('students/{student}/handbook', 'StudentController@handbook');
Route::get('students/{student}/registeredSubjects', 'StudentController@subjects');
Route::get('handbooks/{handbook}/subjects', 'HandbookController@subjects');

Route::post('webhook', 'WebhookController@webhook');
