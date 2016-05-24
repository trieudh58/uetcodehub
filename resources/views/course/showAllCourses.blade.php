@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-label">Các khóa học</div>
        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            <table class="table-display">
                <thead>
                <tr>
                    <th>Tên khóa học</th>
                    <th>Giảng viên</th>
                    <th>Kì học</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>
                            <a data-toggle="modal" data-target="#course-info-data">{{$course->course_name}}</a>
                            <div class="modal fade" id="course-info-data" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Thông tin khóa học</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{$course->description}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{$course->createdUser()}}</td>
                        <td>Học kì 2 năm học 2015-2016</td>
                        @if (!$course->joined)
                        <td>
                            <a data-toggle="modal" data-target="#enroll-modal">Tham gia</a>
                            <div class="modal fade" id="enroll-modal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Xác nhận tham gia</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn muốn tham gia lớp {{$course->course_name}}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::open([
                                                'action' => array('CourseController@joinCourse', $course->course_id),
                                                'class' => 'form-horizontal',
                                                'method' => 'post',
                                            ]) !!}
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary">
                                                        Tham gia lớp
                                                    </button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>

                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                        @else
                        <td>
                            <p>Đã tham gia</p>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection