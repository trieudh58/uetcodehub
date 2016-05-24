@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="page-label">Bài tập môn ...</div>
            <div class="col-md-3">
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
                                    Bảo Triều truyền thêm submission
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