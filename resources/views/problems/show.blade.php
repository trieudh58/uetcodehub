<?php

$problem = new \stdClass();
$problem->name = "Đắc Tùng Dương và găng tay";
$problem->content = "Đại sư huynh Quang Đạt ngay từ hè lớp 10, đã luyện được tuyệt chiêu Nhất Dương Chỉ, từ đó danh chấn võ lâm, ngạo thị quần hùng.
Đắc Dùng Tương – kẻ mới nhập môn – sau khi tra cứu hết các điển tích về chư vị sư huynh, đã quá hâm mộ sư huynh Quang Đạt nên quyết luyện và phổ biến thần công Nhất Dương Chỉ.
Công pháp Nhất Dương Chỉ chia là thượng tầng và hạ tầng. Ở thượng tầng, phải luyện được công phu dùng ngón tay chọc xuyên ghế sắt, sau đó bình yên quay tay và kéo ra.
Mùa đông sắp tới, Đắc Dùng Tương quyết định bán găng tay cho những kẻ luyện thần công Nhất Dương Chỉ.
Gã mang về một số đôi găng tay nhét vào bao tải: X chiếc găng tay màu đen, Y chiếc màu nâu, và Z chiếc màu xám. Bạn chọn găng tay trong bóng tối và có thể kiểm tra chúng chỉ sau một lần chọn, và mỗi lần bạn lấy ra một chiếc găng tay. Số lần lấy nhỏ nhất bạn cần là bao nhiêu để đảm bảo được 1 trong 2 điều kiện sau đây:
A. Ít nhất một đôi cùng màu
B. Mỗi màu ít nhất có một đôi cùng màu đó
Đại sư huynh Quang Đạt ngay từ hè lớp 10, đã luyện được tuyệt chiêu Nhất Dương Chỉ, từ đó danh chấn võ lâm, ngạo thị quần hùng.
Đắc Dùng Tương – kẻ mới nhập môn – sau khi tra cứu hết các điển tích về chư vị sư huynh, đã quá hâm mộ sư huynh Quang Đạt nên quyết luyện và phổ biến thần công Nhất Dương Chỉ.
Công pháp Nhất Dương Chỉ chia là thượng tầng và hạ tầng. Ở thượng tầng, phải luyện được công phu dùng ngón tay chọc xuyên ghế sắt, sau đó bình yên quay tay và kéo ra.
Mùa đông sắp tới, Đắc Dùng Tương quyết định bán găng tay cho những kẻ luyện thần công Nhất Dương Chỉ.
Gã mang về một số đôi găng tay nhét vào bao tải: X chiếc găng tay màu đen, Y chiếc màu nâu, và Z chiếc màu xám. Bạn chọn găng tay trong bóng tối và có thể kiểm tra chúng chỉ sau một lần chọn, và mỗi lần bạn lấy ra một chiếc găng tay. Số lần lấy nhỏ nhất bạn cần là bao nhiêu để đảm bảo được 1 trong 2 điều kiện sau đây:
A. Ít nhất một đôi cùng màu
B. Mỗi màu ít nhất có một đôi cùng màu đó";
$problem->score = 0;
$problem->submitted = false;

$tests = array();
$test = new \stdClass();
$test->testName = "1";
$test->result = "Fail";
$tests[0] = $test;
?>

@extends('layouts.master')

@section('scripts')
<script type="text/javascript">
    $('#expand-button').click(function(e){
      $('#editor-box').toggleClass('fullscreen');
      $('#problem-content').toggle();
  });
</script>
<script src="{{ URL::asset('js/ace-builds/src-min-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
<script>
  var editor = ace.edit("editor");
  editor.setTheme("ace/theme/twilight");
  editor.getSession().setMode("ace/mode/c_cpp");
  function changeLanguage() {
    var language = document.getElementById("language").value;
    switch(language) {
      case "Java":
        editor.getSession().setMode("ace/mode/java");
        break;
      case "C++":
        editor.getSession().setMode("ace/mode/c_cpp");
        break;
      default:
        editor.getSession().setMode("ace/mode/c_cpp");
    }
  }
</script>
@stop

@section('body.content')

<div class="row">
  
  <div class="col-md-4">
    <h4> Mô tả bài toán</h4>    
    <div class="box" id="problem-content">
      <div class="box-header">
        <div class="box-title pull-left">
          <p><i class="fa fa-pencil fa-fw"></i></p>
          <p> {{$problem->name}} </p>
        </div>
      </div>
      <div class="box-content">
        {{ $problem->content }}
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class=""><a href="#editor-box" aria-controls="editor-box" role="tab" data-toggle="tab" aria-expanded="false">Mã nguồn</a></li>
        <li role="presentation" class=""><a href="#result" aria-controls="submit" role="tab" data-toggle="tab" aria-expanded="false">Kết quả</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="editor-box">
          <div class="panel">
            <div class="box">
              <div class="box-header">
                <div class="col-md-10">
                  <div class="form-group" style="width:150px">
                    <select class="form-control" id="language" onchange="changeLanguage()">
                      <option>C++</option>
                      <option>Java</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="box-icon pull-right">
                    <a id="expand-button" title="Expand" role="button"><i class="fa fa-expand" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
              <div class="box-content">
                <div id="editor"></div>
              </div>
            </div>
            <button class="btn btn-primary pull-right" id="submit-button">Submit</button>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="result">
          @if ($problem->submitted)
            <div class="score"> 
              Điểm
              <span> {{ $problem->score}} </span>
            </div>
            <table class="table-display">
              <thead>
                <tr>
                  <td>Tên test</td>
                  <td>Kết quả</td>
                </tr>
              </thead>
              <tbody>
                @foreach ($tests as $test)
                  <tr>
                    <td>{{ $test->testName }}</td>
                    <td>{{ $test->result }}</td>
                  </tr>
                @endforeach 
              </tbody>
            </table>
          @else
            <div class="alert alert-danger">
              <strong>Bạn chưa nộp bài!</strong>
            </div>
          @endif
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@stop