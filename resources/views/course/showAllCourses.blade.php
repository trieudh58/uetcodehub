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
                        <th>Hành động</th>
                    </tr>
                    <tbody>
                    @foreach($courses as $index=>$c)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$c->course_name}}</td>
                            <td>{{$c->createdUser()}}</td>
                            <td width="300px">{{$c->description}}</td>
                            @if(!$c->joined)
                                <td><a href="#">Tham gia lớp</a></td>
                            @else
                                <td><a href="#">Rút khỏi lớp</a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection