@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên môn học</th>
                        <th>Giảng viên</th>
                        <th>Mô tả</th>
                    </tr>
                    <tbody>
                    @foreach($courses as $index=>$c)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$c->course_name}}</td>
                            <td>{{$c->createdUser()}}</td>
                            <td>{{$c->description}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection