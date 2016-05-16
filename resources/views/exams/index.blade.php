<?php
$exams = array();
$exam = new \stdClass();
$exam->examName = "Thi tin 4 - 2014/2015";
$exam->avaiableFrom = "2015-11-19 08:00:00";
$exam->avaiableTo = "2015-11-19 10:00:00";
$exam->duration = "120 phút";
$exam->completed = false;
$exam->problems = "problems";

$exams[0] = $exam;
$exams[1] = $exam;

?>
@extends('layouts.master')
@section('body.content')
<div class="container">
  <h2>
    Kì thi
  </h2> 
  <table class="table-display">
    <thead>
    	<tr>
    		<td>Tên kì thi</td>
    		<td>Thời gian bắt đầu</td>
    		<td>Thời gian kết thúc</td>
    		<td>Thời gian làm bài</td>
        <td>Trạng thái</td>
    	</tr>
    </thead>
    <tbody>
    	@foreach ($exams as $exam)
        <tr>
          <td>{{ $exam->examName }}</td>
          <td>{{ $exam->avaiableFrom }}</td>
          <td>{{ $exam->avaiableTo }}</td>
          <td>{{ $exam->duration }}</td>
          <td>
            @if (!$exam->completed)
            <a data-toggle="modal" data-target="#enroll-modal">Bắt đầu thi</a>
            <div class="modal fade" id="enroll-modal" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Xác nhận tham gia</h4>
                  </div>
                  <div class="modal-body">
                    <p>Bạn muốn bắt đầu kì thi {{$exam->examName}}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href='{{ route($exam->problems) }}'">Đồng ý</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                  </div>
                </div>
              </div>
            </div>
            @else
            <p>Đã hoàn thành</p>            
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop