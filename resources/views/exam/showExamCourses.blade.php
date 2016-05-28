@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="m-heading-1 border-green page-label">
            Danh sách kì thi
        </div>
        <div class="col-md-9">
            <table class="table-display">
                <thead>
                <tr>
                    <th>Tên kì thi</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Thời gian kết thúc</th>
                    <th>Thời gian làm bài</th>
                    <th>Trạng thái</th>
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
                                <a class="btn red" data-toggle="modal" data-target="#enroll-modal-{{$exam->exam_id}}">Bắt đầu thi</a>
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
    </div>
@endsection