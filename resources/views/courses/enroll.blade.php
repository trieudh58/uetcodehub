<?php
$courses = array();
$course = new \stdClass();
$course->courseName = "Tin học cơ sở 4";
$course->createdUser = "TS. Nguyễn Văn Vinh";
$course->description = "Cơ bản về C/C++";
$course->complete = "40";
$course->problems = "problems";

$courses[0] = $course;
$courses[1] = $course;

?>
@extends('layouts.master')
@section('body.content')
<div class="container">
  <table class="table-display">
    <thead>
      <tr>
        <th>Tên khóa học</th>
        <th>Giảng viên</th>
        <th>Mô tả</th>
        <th>Hoàn thành</th>
      </tr>
    </thead>
    <tbody>
    	@foreach ($courses as $course)
    	<tr>
    		<td><a href="{{ route($course->problems) }}"> {{$course->courseName}} </a></td>
    		<td> {{$course->createdUser}} </td>
    		<td> {{$course->description}} </td>
    		<td>
    			<div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="$course->complete"
            aria-valuemin="0" aria-valuemax="100" style="width:40%">
              {{$course->complete}}% Complete (success)
            </div>
          </div>
    		</td>
    	</tr>
    	@endforeach
    </tbody>
  </table>
</div>
@stop