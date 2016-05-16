<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
    //return view('layouts.master');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/my-courses', 'CourseController@showCourses')->middleware('auth');
Route::get('/all-courses', 'CourseController@showAllCourses')->middleware('auth');
Route::get('/my-courses/{course_id}/exercises', 'CourseController@showExercises')->middleware('auth');

Route::post('/join/{course_id}', 'CourseController@joinCourse')->middleware('auth');
Route::post('/leave/{course_id}', 'CourseController@leaveCourse')->middleware('auth');


Route::group(['prefix' => '/courses'], function(){
    Route::get('/', [
        'as' => 'courses.index',
        'uses' => 'CoursesController@index'
    ]);
    Route::get('/enrolled', [
        'as' => 'courses.enrolled',
        'uses' => 'CoursesController@showEnrolledCourses'
    ]);
});

//Exams
Route::group(['prefix' => '/exams'], function(){
    Route::get('/', [
        'as' => 'exams.index',
        'uses' => 'ExamsController@index'
    ]);
    Route::get('/{id}', [
        'as' => 'exams.{id}',
        'uses' => 'ExamsController@show'
    ]);
});

//Problem
Route::group(['prefix' => '/problems'], function(){
    Route::get('/', [
        'as' => "problems",
        'uses'=> "ProblemController@index"
    ]);

    Route::get('/show', [
        'as' => "problems",
        'uses'=> "ProblemController@show"
    ]);

    Route::post('/', [
        'as' => "problems.submission",
        'uses' => "ProblemController@submit"
    ]);
});
