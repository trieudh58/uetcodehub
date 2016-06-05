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

Route::get('/sample', 'HomeController@sample');

Route::get('/home', 'HomeController@index');
Route::get('/my-courses', 'CourseController@showCourses')->middleware('auth');
Route::get('/all-courses', 'CourseController@showAllCourses')->middleware('auth');
Route::get('/my-courses/{course_id}/problems', 'CourseController@showProblems')->middleware('auth');
Route::get('/my-courses/{course_id}/problems/{problem_id}', 'CourseController@showProblemDetail')->middleware('auth');
Route::get('/exams', 'ExamController@showExamCourses')->middleware('auth');
Route::get('/exams/{exam_id}', 'ExamController@showExamDetail')->middleware('auth');
Route::get('/exams/{exam_id}/problems/{problem_id}', 'ExamController@showProblemDetail')->middleware('auth');

Route::get('/submitAjax', function(){
    if(Request::ajax()){
        return 'ajax data';
    }
});


Route::post('/join/{course_id}', 'CourseController@joinCourse')->middleware('auth');
Route::post('/leave/{course_id}', 'CourseController@leaveCourse')->middleware('auth');
Route::post('/submit/{course_id}/{problem_id}', 'JudgeController@submit')->middleware('auth');
//Route::post('/submit/{course_id}/{problem_id}', 'JudgeController@submitAjax')->middleware('auth');
Route::post('/submit-exam/{exam_id}/{problem_id}', 'JudgeController@submitExam')->middleware('auth');

//Route::post('/submitPostAjax', function(){
//    if(Request::ajax()){
//        //return var_dump(Request::all());
//        return $_POST['language'] . ' ' . $_POST['sourceCode'];
//    }
//});

Route::post('submitPostAjax', ['uses' => 'JudgeController@submitAjax']);
