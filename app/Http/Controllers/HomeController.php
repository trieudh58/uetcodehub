<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if(Auth::guest()){
            $statistic = new \App\CustomClass\Statistic;
            return view('welcome', compact('statistic'));
        //}else{
        //  return view("user.user");
        //}
    }

    public function user(){
        $statistic = new \App\CustomClass\Statistic;
        return view("user.user", compact('statistic'));
    }

}
