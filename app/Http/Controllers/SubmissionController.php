<?php
/**
 * Created by PhpStorm.
 * User: hmduong
 * Date: 6/7/2016
 * Time: 9:42 AM
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class SubmissionController extends Controller{
    
    public function submissionDetail($courseId, $problemId){
        $submissions = Auth::user()->submissions($courseId, $problemId);
        return view('submission.submissionTable', compact('submissions'));
    }
    
}
