<?php
$examName = "Kì thi ABC";
$problems = array();

$problem = new \stdClass();
$problem->problemName = "Fibonaci";
$problem->content = "Sinh dãy Fibonaci";
$problem->timelimit = "2a";

$problems[0] = $problem;
$problems[1] = $problem;
?>

@extends('layouts.master')
@section('body.content')
<div class="container">
  <h2>
    {{ $examName }}
  </h2> 
  <table class="table-display">
    <thead>
    	<tr>
    		<td>Tên bài toán</td>
    		<td>Mô tả</td>
    		<td>Time limit</td>
    	</tr>
    </thead>
    <tbody>
    	@foreach ($problems as $problem)
        <tr>
          <td>{{ $problem->problemName }}</td>
          <td>{{ $problem->content }}</td>
          <td>{{ $problem->timelimit }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop