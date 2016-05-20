@extends('layouts.app')

@section('content')
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
                    <td>{{$exam->exam_name}}</td>
                    <td>{{$exam->available_from}}</td>
                    <td>{{$exam->available_to}}</td>
                    <td>{{$exam->duration}} phút</td>
                    <td>
                        @if (!$exam->completed)
                            <a data-toggle="modal" data-target="#enroll-modal-{{$exam->exam_id}}">Bắt đầu thi</a>
                            <div class="modal fade" id="enroll-modal-{{$exam->exam_id}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Xác nhận tham gia</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn muốn bắt đầu kì thi {{$exam->exam_name}}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href='{{url('/exams/'.$exam->exam_id)}}';">Đồng ý</button>
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
@endsection