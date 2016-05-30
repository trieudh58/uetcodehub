@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-label">Các khóa học của bạn</div>
        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            @if(sizeof($courses) > 0)
                <table class="table-display">
                    <thead>
                    <tr>
                        <th>Tên khóa học</th>
                        <th>Giảng viên</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td><a href="{{url('/my-courses/'.$course->courseId.'/problems')}}"> {{$course->courseName}} </a></td>
                            <td> {{$course->createdUser()}} </td>
                            <td> {{$course->description}} </td>
                            <td>
                                {!! Form::open([
                                    'action' => array('CourseController@leaveCourse', $course->courseId),
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
                </table>
            @else
                Bạn chưa tham gia lớp học nào!
            @endif
        </div>
    </div>
@endsection