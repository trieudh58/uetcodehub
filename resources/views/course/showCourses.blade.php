@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                @if(sizeof($courses) > 0)
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
                                <td><a href="{{url('/my-courses/'.$c->course_id.'/exercises')}}">{{$c->course_name}}</a></td>
                                <td>{{$c->createdUser()}}</td>
                                <td width="300px">{{$c->description}}</td>
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
                            </tr>
                        @endforeach
                        </tbody>
                        </thead>
                    </table>
                @else
                    Bạn chưa tham gia lớp học nào!
                @endif
            </div>
        </div>
    </div>
@endsection