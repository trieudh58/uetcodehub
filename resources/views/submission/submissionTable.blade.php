@if (sizeof($submissions))
    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">All Result</div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
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
    </div>
@else
    <div class="alert alert-danger">
        <strong>Bạn chưa nộp bài!</strong>
    </div>
@endif