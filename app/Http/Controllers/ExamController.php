<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

use App\Http\Requests;

class ExamController extends Controller
{
    public function showExamCourses()
    {
        $exams = Exam::all();
        return view('exam.showExamCourses', compact('exams'));
    }
    
    public function showExamDetail($exam_id)
    {
        $exam = Exam::find($exam_id);
        $problems = $exam->problems;
        return view('exam.showExamDetail', compact('problems'));
    }
}
