@extends('layouts.app')

@section('extendedHead')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('script')
    <script type="text/javascript">
        $('#expand-button').click(function (e) {
            $('#editor-box').toggleClass('fullscreen');
            $('#problem-content').toggle();
        });
    </script>
    <script src="{{ URL::asset('js/ace-builds/src-min-noconflict/ace.js') }}" type="text/javascript"
            charset="utf-8"></script>
    <script>
        var editor = ace.edit("editor");
        var textarea = $('#source_code');
        editor.setTheme("ace/theme/twilight");
        editor.getSession().setMode("ace/mode/c_cpp");
        function changeLanguage() {
            var language = document.getElementById("language").value;
            switch (language) {
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
        document.getElementById("editor").style.width = "100%"
        document.getElementById("editor").style.height = "300px"
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            {{--$('#submit-button').click(function () {--}}
                {{--$.get('{{url('/submitAjax')}}', function(data){--}}
                    {{--$('#ajaxDemoContent').append(data);--}}
                    {{--console.log(data);--}}
                {{--});--}}
            {{--});--}}
            $('#frmSubmit').submit(function () {
                var _sourceCode = $('#source_code').val();
                var _language = $('#language').val();

                $.ajax({
                    type: "POST",
                    url: "{{url('/submitPostAjax')}}",
                    data: {sourceCode: _sourceCode, language: _language, courseId: {{$courseId}}, problemId: {{$problem->problemId}}},
                    success: function (data) {
                        console.log(data);
                        $('#ajaxDemoContent').html(data);
                    }
                });
            });
        });
    </script>
@stop
@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="portlet light portlet-fit full-height-content full-height-content-scrollable ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Mô tả bài toán</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="box full-height-content-body" id="problem-content">
                        <div class="box-header">
                            <div class="box-title pull-left">
                                <p><i class="fa fa-pencil fa-fw"></i></p>
                            </div>
                        </div>
                        <div class="box-content">
                            {!! $problem->content !!}
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-8">
            <div class="portlet light portlet-fit full-height-content full-height-content-scrollable ">
                <div class="portlet-body">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class=""><a href="#editor-box" aria-controls="editor-box" role="tab"
                                                                data-toggle="tab" aria-expanded="false">Mã nguồn</a>
                            </li>
                            <li role="presentation" class=""><a href="#result" aria-controls="submit" role="tab"
                                                                data-toggle="tab" aria-expanded="false">Kết quả</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div role="tabpanel"
                                 class="tab-pane {{Session::get('is_submitted') == true ? '' : 'active'}}"
                                 id="editor-box">
                                {{--{!! Form::open([--}}
                                {{--'action' => array('JudgeController@submit', $courseId, $problem->problemId),--}}
                                {{--'method' => 'post',--}}
                                {{--]) !!}--}}
                                {{--{!! Form::open([--}}
                                {{--'action' => array('JudgeController@submitAjax', $courseId, $problem->problemId),--}}
                                {{--'method' => 'post',--}}
                                {{--]) !!}--}}
                                <form id="frmSubmit" onsubmit="return false">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="panel">
                                        <div class="box">
                                            <div class="box-header">

                                            </div>
                                            <div class="box-content">
                                                <div class="form-group" hidden>
                                                <textarea class="form-control" name="source_code"
                                                          id="source_code"></textarea>
                                                </div>
                                                <div id="editor"></div>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top: 5px">
                                            <div class="pull-left" style="width:150px">
                                                <select class="form-control" name="language" id="language"
                                                        onchange="changeLanguage()">
                                                    <option value="Cpp">C++</option>
                                                    <option value="Java">Java</option>
                                                </select>
                                            </div>
                                            <div>
                                                <input class="btn btn-primary pull-right" type="submit"
                                                       id="submit-button">
                                                Submit
                                                </input>
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                        <div id="ajaxDemoContent">Demo content</div>
                                    </div>
                                </form>
                                {{--                                {!! Form::close() !!}--}}
                            </div>
                            <div role="tabpanel"
                                 class="tab-pane {{Session::get('is_submitted') == true ? 'active' : ''}}" id="result">

                                @if (sizeof($submissions))
                                    <div class="portlet box red">
                                        <div class="portlet-title">
                                            <div class="caption">All Result</div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-condensed table-hover" id="tblResult">
                                                    <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Score</td>
                                                        <td>Message</td>
                                                        <td>Status</td>
                                                    </tr>
                                                    </thead>
                                                    @foreach($submissions as $submission)
                                                        <?php $resultDetail = json_decode($submission->result, true) ?>
                                                        <tr>
                                                            <td>
                                                                {{$submission->submitId}}
                                                            </td>
                                                            @if($resultDetail['resultCode'] === 'AC')
                                                                <td>{{$resultDetail['score']}}</td>
                                                                <td>
                                                                    <?php $testDetail = $resultDetail['testDetail'] ?>
                                                                    @foreach($testDetail as $tc)
                                                                        {{$tc['testName']}} {{$tc['result']}} {{$tc['message']}}
                                                                        <br/>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    <span class="label label-sm label-success">Accept</span>
                                                                </td>
                                                            @elseif(!$resultDetail['resultCode'])
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>
                                                                    <span class="label label-sm label-info">Pending</span>
                                                                </td>
                                                            @else
                                                                <td>0</td>
                                                                <td>{{$resultDetail['message']}}</td>
                                                                <td>
                                                                    <span class="label label-sm label-danger">Fail</span>
                                                                </td>
                                                            @endif

                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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

        </div>
    </div>
@endsection