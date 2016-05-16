<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ExamsController extends Controller{
	function index(){
		return view('exams.index');
	}

	function show($examId){
		
		return view('exams.show');
	}
}

