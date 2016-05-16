@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                @if(sizeof($exercises) > 0)
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
                        @foreach($exercises as $index=>$ex)
                            <tr>
                                <td>Problem {{$index + 1}}</td>
                                <td width="300px">{{$ex->content}}</td>
                                <td>{{$ex->time_limit}}</td>
                                <td>{{$ex->pivot->hard_level}}</td>
                                <td>{{$ex->pivot->score_in_course}}</td>
                                <td>
                                    @if($ex->pivot->is_active)
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