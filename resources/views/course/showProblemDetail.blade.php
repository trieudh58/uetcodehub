@extends('layouts.app')
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
        document.getElementById("editor").style.width="100%"
        document.getElementById("editor").style.height="300px"

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
                                {!! Form::open([
                                        'action' => array('JudgeController@submit', $courseId, $problem->problemId),
                                        'method' => 'post',
                                    ]) !!}
                                <div class="panel">
                                    <div class="box">
                                        <div class="box-header">
                                            <div class="col-md-10">
                                                <div class="form-group" style="width:150px">
                                                    <select class="form-control" name="language" id="language"
                                                            onchange="changeLanguage()">
                                                        <option>C++</option>
                                                        <option>Java</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="box-icon pull-right">
                                                    <a id="expand-button" title="Expand" role="button"><i
                                                                class="fa fa-expand" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-content">
                                            <div class="form-group" hidden>
                                                <textarea class="form-control" name="source_code"
                                                          id="source_code"></textarea>
                                            </div>

                                            @if(sizeof($submissions))
                                                <div id="editor">{{$submissions[sizeof($submissions)-1]->sourceCode}}</div>
                                            @else
                                                <div id="editor"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <button class="btn btn-primary pull-right" type="submit" id="submit-button">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div role="tabpanel"
                                 class="tab-pane {{Session::get('is_submitted') == true ? 'active' : ''}}" id="result">
                                @if (sizeof($submissions))
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>Id</td>
                                            <td>Result</td>
                                            <td>Score</td>
                                            <td>Message</td>
                                        </tr>
                                        </thead>
                                        @foreach($submissions as $submission)
                                            <?php $resultDetail = json_decode($submission->result, true) ?>
                                            <tr>

                                                <td>
                                                    {{$submission->submitId}}
                                                </td>
                                                <td>
                                                    {{$resultDetail['resultCode']}}
                                                </td>
                                                @if($resultDetail['resultCode'] === 'AC')
                                                    <td>
                                                        {{$resultDetail['score']}}
                                                    </td>
                                                    <td>
                                                        <?php $testDetail = $resultDetail['testDetail'] ?>
                                                        @foreach($testDetail as $tc)
                                                            {{$tc['testName']}} {{$tc['result']}} {{$tc['message']}}
                                                            <br/>
                                                        @endforeach
                                                    </td>
                                                @else
                                                    <td>
                                                        {{ 0  }}
                                                    </td>
                                                    <td>
                                                        {{ $resultDetail['message'] }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
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