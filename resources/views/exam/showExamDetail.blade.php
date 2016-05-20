@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table-display">
            <thead>
            <tr>
                <th>Tên bài</th>
                <th>Đề bài</th>
                <th>Điểm tối đa</th>
                <th>Thời gian chạy tối đa</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($problems as $index=>$problem)
                <tr>
                    <td>Bài {{$index + 1}}</td>
                    <td>{{substr($problem->content, 0, 100)}}... </td>
                    <td>{{$problem->pivot->score_in_exam}} </td>
                    <td>{{$problem->time_limit}} s</td>
                    <td><a href="{{url('/exams/'.$exam_id.'/problems/'.$problem->problem_id)}}">Làm bài</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection