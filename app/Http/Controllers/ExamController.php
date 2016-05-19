<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ExamController extends Controller
{
    public function showExamCourses()
    {
        return view('exam.showExamCourses');
    }
}
