<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProblemController extends Controller{
    public function index(){
    	return view('problems.index');
    }

    public function show(){
    	return view('problems.show');
    }
}
