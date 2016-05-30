@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-label">Truyền tên kì thi</div>
        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            <table class="table-display">
                <thead>
                <tr>
                    <th>Tên bài</th>
                    <th>Đề bài</th>
                    <th>Điểm tối đa</th>
                    <th>Giới hạn thời gian chạy</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($problems as $index=>$problem)
                    <tr>
                        <td>Bài {{$index + 1}}</td>
                        <td>{{substr($problem->content, 0, 100)}}... </td>
                        <td>{{$problem->pivot->scoreInExam}} </td>
                        <td>{{$problem->timeLimit}} s</td>
                        <td><a href="{{url('/exams/'.$examId.'/problems/'.$problem->problemId)}}">Làm bài</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection