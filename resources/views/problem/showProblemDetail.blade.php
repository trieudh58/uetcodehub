@extends('layouts.app')
@section('script')
    <script type="text/javascript">
        $('#expand-button').click(function(e){
            $('#editor-box').toggleClass('fullscreen');
            $('#problem-content').toggle();
        });
    </script>
    <script src="{{ URL::asset('js/ace-builds/src-min-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        var editor = ace.edit("editor");
        var textarea = $('#source_code');
        editor.setTheme("ace/theme/twilight");
        editor.getSession().setMode("ace/mode/c_cpp");
        function changeLanguage() {
            var language = document.getElementById("language").value;
            switch(language) {
                case "Java":
                    editor.getSession().setMode("ace/mode/java");
                    break;
                case "C++":
                    editor.getSession().setMode("ace/mode/c_cpp");
                    break;
                default:
                    editor.getSession().setMode("ace/mode/c_cpp");
            }
        }
        editor.getSession().on('change', function () {
            textarea.val(editor.getSession().getValue());
        });
        textarea.val(editor.getSession().getValue());

    </script>
@stop
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        <span class="caption-subject font-blue bold uppercase">Đề bài</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">

                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" style="height: 350px;" data-always-visible="1" data-rail-visible="0">
                        {{$problem->content}}
                    </div>
                    <div class="scroller-footer">
                        <div class="pull-right font-blue">
                            ==========
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class=""><a href="#editor-box" aria-controls="editor-box" role="tab" data-toggle="tab" aria-expanded="false">Mã nguồn</a></li>
                    <li role="presentation" class=""><a href="#result" aria-controls="submit" role="tab" data-toggle="tab" aria-expanded="false">Kết quả</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane {{Session::get('is_submitted') == true ? '' : 'active'}}" id="editor-box">
                        {!! Form::open([
                                'action' => array('JudgeController@submit', $course_id, $problem->problem_id),
                                'method' => 'post',
                            ]) !!}
                        <div class="panel">
                            <div class="portlet light bordered">
                                <div class="portlet-title" style="height: 50px">
                                    <div class="caption">
                                        <div class="form-group" style="width:150px">
                                            <select class="form-control" name="language" id="language" onchange="changeLanguage()">
                                                <option>C++</option>
                                                <option>Java</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <div class="btn-group">
                                            <div class="btn dark btn-outline btn-square btn-sm pull-right">
                                                <a id="expand-button" title="Expand" role="button"><i class="fa fa-expand" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height: 350px;" data-always-visible="1" data-rail-visible="0">
                                        <div class="form-group" hidden>
                                            <textarea class="form-control" name="source_code" id="source_code"></textarea>
                                        </div>
                                        @if(sizeof($submissions))
                                            <div id="editor">{{$submissions[sizeof($submissions)-1]->source_code}}</div>
                                        @else
                                            <div id="editor"></div>
                                        @endif
                                    </div>
                                    <div class="scroller-footer">
                                        <div class="form-group">
                                            <div>
                                                <button class="btn btn-primary pull-right" type="submit" id="submit-button">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div role="tabpanel" class="tab-pane {{Session::get('is_submitted') == true ? 'active' : ''}}" id="result">
                        @if (sizeof($submissions))
                            @if (json_decode($submissions[sizeof($submissions) - 1]->result, true)['resultCode'] === 'AC')
                                <div class="score">
                                    Điểm:
                                    <span> {{$submissions[sizeof($submissions) - 1]->result_score}} </span>
                                </div>
                                <table class="table-display">
                                    <thead>
                                    <tr>
                                        <th>Tên test</th>
                                        <th>Kết quả</th>
                                        <th>Thông báo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach (json_decode($submissions[sizeof($submissions) - 1]->result, true)['testDetail'] as $test)
                                        <tr>
                                            <td>{{$test['testName']}}</td>
                                            <td>{{$test['result']}}</td>
                                            <td>{{$test['message']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @elseif (json_decode($submissions[sizeof($submissions) - 1]->result, true)['resultCode'] === 'CE')
                                <div class="alert alert-danger">
                                    <strong>{{json_decode($submissions[sizeof($submissions) - 1]->result, true)['message']}}</strong>
                                </div>
                            @elseif (json_decode($submissions[sizeof($submissions) - 1]->result, true)['resultCode'] === 'VS')
                                <div class="alert alert-danger">
                                    <strong>{{json_decode($submissions[sizeof($submissions) - 1]->result, true)['message']}}</strong>
                                </div>
                            @elseif (json_decode($submissions[sizeof($submissions) - 1]->result, true)['resultCode'] === 'NA')
                                <div class="alert alert-danger">
                                    <strong>{{json_decode($submissions[sizeof($submissions) - 1]->result, true)['message']}}</strong>
                                </div>
                            @endif
                        @else
                            <div class="alert alert-danger">
                                <strong>Bạn chưa nộp bài!</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection