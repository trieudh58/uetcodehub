<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Course;

class CoursesController extends Controller{
	function index(){
		return view('courses.index');
	}

	function showEnrolledCourses(){
		//$courseusers = \DB::table('courseuser')->where('userId', userId)->get();


		return view('courses.enroll');
	}
}

