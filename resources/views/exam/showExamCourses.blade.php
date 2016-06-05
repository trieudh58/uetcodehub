@extends('layouts.app')

{{--@section('pageTitle')--}}
{{--Exams--}}
{{--@endsection--}}

@section('content')

    <div class="portlet light portlet-fit full-height-content full-height-content-scrollable ">
        <div class="portlet-title">
            <div class="caption">
                <i class=" icon-layers font-green"></i>
                <span class="caption-subject font-green bold uppercase">Exams</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
                <table class="table table-hover table-light">
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
                            <td>{{$exam->examName}}</td>
                            <td>{{$exam->availableFrom}}</td>
                            <td>{{$exam->availableTo}}</td>
                            <td>{{$exam->duration}} phút</td>
                            <td>
                                @if (!$exam->completed)
                                    <a data-toggle="modal" data-target="#enroll-modal-{{$exam->examId}}">Bắt đầu thi</a>
                                    <div class="modal fade" id="enroll-modal-{{$exam->examId}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Xác nhận tham gia</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn muốn bắt đầu kì thi {{$exam->examName}}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                            onclick="location.href='{{url('/exams/'.$exam->examId)}}';">
                                                        Đồng
                                                        ý
                                                    </button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Hủy
                                                        bỏ
                                                    </button>
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
    </div>

@endsection