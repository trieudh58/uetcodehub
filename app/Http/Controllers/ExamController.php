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
        return view('exam.showExamDetail', compact('exam_id', 'problems'));
    }

    public function showProblemDetail($exam_id, $problem_id)
    {
        $exam = Exam::find($exam_id);
        $problems = $exam->problems;
        $problem = $problems->find($problem_id);
        $submissions = $problem->submissions;
        return view('exam.showProblemDetail', compact('exam_id', 'problem', 'submissions'));
    }
}
