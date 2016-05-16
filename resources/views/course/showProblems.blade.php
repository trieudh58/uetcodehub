@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                @if(sizeof($problems) > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Đề bài</th>
                            <th>Giới hạn thời gian chạy</th>
                            <th>Độ khó</th>
                            <th>Tổng điểm</th>
                            <td>Trạng thái</td>
                        </tr>
                        <tbody>
                        @foreach($problems as $index=>$p)
                            <tr>
                                <td><a href="{{url(Request::path().'/'.$p->problem_id)}}">Problem {{$index + 1}}</a></td>
                                <td width="300px">{{$p->content}}</td>
                                <td>{{$p->time_limit}}</td>
                                <td>{{$p->pivot->hard_level}}</td>
                                <td>{{$p->pivot->score_in_course}}</td>
                                <td>
                                    @if($p->pivot->is_active)
                                        Chưa nộp
                                    @else
                                        Đã nộp
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </thead>
                    </table>
                @else
                    Chưa có bài tập nào!
                @endif
            </div>
        </div>
    </div>
@endsection