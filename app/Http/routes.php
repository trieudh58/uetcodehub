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
Route::get('/my-courses/{course_id}/problems', 'CourseController@showProblems')->middleware('auth');
Route::get('/my-courses/{course_id}/problems/{problem_id}', 'CourseController@showProblemDetail')->middleware('auth');

Route::post('/join/{course_id}', 'CourseController@joinCourse')->middleware('auth');
Route::post('/leave/{course_id}', 'CourseController@leaveCourse')->middleware('auth');
