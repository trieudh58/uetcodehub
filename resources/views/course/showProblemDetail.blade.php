@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Đề bài</h3>
                <p>{{$problem->content}}</p>
            </div>
            <div class="col-md-6">
                <div>
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active">
                            <a data-toggle="tab" href="#source_code">Mã nguồn</a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" href="#submissions">Bài đã nộp</a>
                        </li>
                    </ul>
                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="source_code">
                            <p>{{$submissions[0]->source_code}}</p>
                        </div>
                        <div class="tab-pane" id="submissions">
                            @if(sizeof($submissions))
                                @foreach($submissions as $index => $sm)
                                    <h4>Lần {{$index + 1}}</h4>
                                    <h4>Thời gian nộp: {{$sm->submit_time}}</h4>
                                    <h4>Thời gian chạy: {{$sm->compile_time != null ? $sm->compile_time : 'Chưa có'}}</h4>
                                    <h4>Điểm: {{$sm->result_score != null ? $sm->result_score : 'Chưa có'}}</h4>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection