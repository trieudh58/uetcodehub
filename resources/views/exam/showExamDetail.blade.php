@extends('layouts.app')

@section('content')
<div class="m-heading-1 border-red page-label">
    Kì thi: {{$exam_name}}
</div>
<div class="col-md-9">
    <table class="table-display">
        <thead>
        <tr>
            <th>Tên bài</th>
            <th>Đề bài</th>
            <th>Điểm tối đa</th>
            <th>Time limit</th>
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
                <td><a class="btn sbold btn-outline red" href="{{url('/exams/'.$exam_id.'/problems/'.$problem->problem_id)}}">Làm bài</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection