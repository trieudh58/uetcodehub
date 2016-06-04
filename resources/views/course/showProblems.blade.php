@extends('layouts.app')

{{--@section('pageTitle')--}}
    {{--Môn học ...--}}
{{--@endsection--}}

@section('content')

    <div class="portlet light portlet-fit full-height-content full-height-content-scrollable ">
        <div class="portlet-title">
            <div class="caption">
                <i class=" icon-layers font-green"></i>
                <span class="caption-subject font-green bold uppercase">Course ...</span>
            </div>
        </div>
        <div class="portlet-body">
            @if(sizeof($problems) > 0)
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tag value</th>
                            <th>Giới hạn thời gian chạy</th>
                            <th>Độ khó</th>
                            <th>Tổng điểm</th>
                            <th>Trạng thái</th>
                        </tr>
                        <tbody>
                        @foreach($problems as $index=>$p)
                            <tr>
                                <td><a href="{{url(Request::path().'/'.$p->problemId)}}">Bài {{$index + 1}}</a></td>
                                <td width="300px">{{$p->tagValues}}</td>
                                <td>{{$p->timeLimit}}</td>
                                <td>{{$p->pivot->hardLevel}}</td>
                                <td>{{$p->pivot->scoreInCourse}}</td>
                                <td>
                                    @if($p->isActive)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </thead>
                    </table>
                </div>
            @else
                Chưa có bài tập nào!
            @endif

        </div>
    </div>



@endsection