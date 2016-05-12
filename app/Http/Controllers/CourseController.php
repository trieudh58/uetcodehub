<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function showCourses()
    {
        $courses = Auth::user()->courses;
        return view('course.showCourses', compact('courses'));
    }
}
