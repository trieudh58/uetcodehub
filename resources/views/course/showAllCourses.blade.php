@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(sizeof($courses) > 0)
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
                                    <td>
                                        {!! Form::open([
                                            'action' => array('CourseController@joinCourse', $c->course_id),
                                            'class' => 'form-horizontal',
                                            'method' => 'post',
                                        ]) !!}
                                        <div class="form-group">
                                            <div>
                                                <button type="submit" class="btn btn-default">
                                                    Tham gia lớp
                                                </button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                @else
                                    <td>
                                        {!! Form::open([
                                            'action' => array('CourseController@leaveCourse', $c->course_id),
                                            'class' => 'form-horizontal',
                                            'method' => 'post',
                                        ]) !!}
                                        <div class="form-group">
                                            <div>
                                                <button type="submit" class="btn btn-danger">
                                                    Rút khỏi lớp
                                                </button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                        </thead>
                    </table>
                @else
                    Chưa có lớp học nào được mở!
                @endif
            </div>
        </div>
    </div>
@endsection