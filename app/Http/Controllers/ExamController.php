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
    
    public function showExamDetail($examId)
    {
        $exam = Exam::find($examId);
        $problems = $exam->problems;
        return view('exam.showExamDetail', compact('examId', 'problems'));
    }

    public function showProblemDetail($examId, $problemId)
    {
        $exam = Exam::find($examId);
        $problems = $exam->problems;
        $problem = $problems->find($problemId);
        $submissions = $problem->submissions;
        return view('exam.showProblemDetail', compact('examId', 'problem', 'submissions'));
    }
}
