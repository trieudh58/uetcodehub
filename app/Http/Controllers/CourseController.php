<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Problem;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public function showCourses()
    {
        $courses = Auth::user()->courses->sortBy('course_name')->values();
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

    public function joinCourse($course_id)
    {
        $user = Auth::user();
        $user->courses()->attach($course_id);
        return Redirect::back();
    }

    public function leaveCourse($course_id)
    {
        $user = Auth::user();
        $user->courses()->detach($course_id);
        return Redirect::back();
    }

    public function showProblems($course_id)
    {
        $courses = Auth::user()->courses->find($course_id);
        $problems = $courses->problems;
        return view('course.showProblems', compact('problems'));
    }

    public function showProblemDetail($problem_id)
    {
        $problem = Problem::find($problem_id);
        $submissions = $problem->submissions;
        return view('course.showProblemDetail', compact('problem', 'submissions'));
    }
}
