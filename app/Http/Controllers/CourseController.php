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
        $courses = Auth::user()->courses->sortBy('course_name');
        return view('course.showCourses', compact('courses'));
    }

    public function showAllCourses()
    {
        $courses = Course::orderBy('course_name')->get();
        $joined_courses = Auth::user()->courses;
        foreach ($courses as $c) {
            $c->joined = false;
            foreach ($joined_courses as $jc) {
                if ($jc->course_id == $c->course_id) {
                    $c->joined = true;
                    break;
                }
            }
        }
        return view('course.showAllCourses', compact('courses'));
    }
}
