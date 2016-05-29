@extends('layouts.app')

@section('content')
<div class="row">
    <div class="m-heading-1 border-red page-label">
        Bài tập môn {{$course_name}}
    </div>
    <div class="col-md-9">
        @if(sizeof($problems) > 0)
            <table class="table-display">
                <thead>
                <tr>
                    <th>Thứ tự</th>
                    <th>Tag value</th>
                    <th>Giới hạn thời gian chạy</th>
                    <th>Độ khó</th>
                    <th>Tổng điểm</th>
                    <th>Trạng thái</th>
                </tr>
                <tbody>
                @foreach($problems as $index=>$p)
                    <tr>
                        <td><a href="{{url(Request::path().'/'.$p->problem_id)}}">Bài {{$index + 1}}</a></td>
                        <td width="300px">{{$p->tag_values}}</td>
                        <td>{{$p->time_limit}}</td>
                        <td>{{$p->pivot->hard_level}}</td>
                        <td>{{$p->pivot->score_in_course}}</td>
                        <td>
                            @if (sizeof($p->submissions))
                                <a class="btn sbold btn-outline yellow-gold" href="{{url(Request::path().'/'.$p->problem_id)}}">Đã hoàn thành</a>
                            @else
                                <a class="btn sbold btn-outline grey" href="{{url(Request::path().'/'.$p->problem_id)}}">Chưa hoàn thành</a>
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
@endsection