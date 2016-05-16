<?php
$courses = array();
$course = new \stdClass();
$course->courseName = "Tin học cơ sở 4";
$course->createdUser = "TS. Nguyễn Văn Vinh";
$course->description = "Cơ bản về C/C++";
$course->enrolled = false;
$course->semester = "Học kì 1 năm học 2014 - 2015";
$course->problems = "problems";

$courses[0] = $course;
$courses[1] = $course;
?>

@extends('layouts.master')
@section('body.content')
<div class="container">
  <h2>Lớp của tôi</h2>
  <table class="table-display">
    <thead>
      <tr>
        <td>Tên khóa học</td>
        <td>Giảng viên</td>
        <td>Kì học</td>
        <td>Trạng thái</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($courses as $course)
      <tr>
        <td>
          <a data-toggle="modal" data-target="#course-info-data">{{$course->courseName}}</a>
          <div class="modal fade" id="course-info-data" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Thông tin khóa học</h4>
                </div>
                <div class="modal-body">
                  <p>{{$course->description}}</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td>{{$course->createdUser}}</td>
        <td>{{$course->semester}}</td>
        <td>
          @if (!$course->enrolled)
          <a data-toggle="modal" data-target="#enroll-modal">Tham gia</a>
          <div class="modal fade" id="enroll-modal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Xác nhận tham gia</h4>
                </div>
                <div class="modal-body">
                  <p>Bạn muốn tham gia lớp {{$course->courseName}}?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href='{{ route($course->problems) }}'">Đồng ý</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                </div>
              </div>
            </div>
          </div>
          @else
          <p>Đã tham gia</p>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@stop