@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table-display">
            <thead>
            <tr>
                <th></th>
                <th>Đề bài</th>
                <th>Điểm tối đa</th>
                <th>Thời gian chạy tối đa</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($problems as $index=>$problem)
                <tr>
                    <td><a href="{{url('/exams/'.$exam_id.'/problems/'.$problem->problem_id)}}">Bài {{$index + 1}}</a></td>
                    <td>{{substr($problem->content, 0, 100)}}... </td>
                    <td>{{$problem->pivot->score_in_exam}} </td>
                    <td>{{$problem->time_limit}} s</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection