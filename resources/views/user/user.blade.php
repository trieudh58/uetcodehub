@extends('layouts.app')

@section('extendedHead')
    <link href="{{URL('assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{URL('assets/pages/media/profile/default_user.jpg')}}" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{Auth::user()->getFullname()}}</div>
                        <div class="profile-usertitle-job"> {{Auth::user()->Role->roleName}}</div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->

                    <!-- PORTLET MAIN -->
                    <div class="portlet light ">
                        <!-- STAT -->
                        <div class="row list-separated profile-stat">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> {{Auth::user()->courses()->count()}}</div>
                                <div class="uppercase profile-stat-text"> Courses</div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> {{Auth::user()->totalScore()}}</div>
                                <div class="uppercase profile-stat-text"> Score</div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> {{Auth::user()->currentRanking()}}</div>
                                <div class="uppercase profile-stat-text"> Ranking</div>
                            </div>
                        </div>
                        <!-- END STAT -->
                        <div>
                            <h4 class="profile-desc-title">About Marcus Doe</h4>
                            <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-globe"></i>
                                <a href="http://www.keenthemes.com">www.uetcodehub.com</a>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-twitter"></i>
                                <a href="http://www.twitter.com/keenthemes/">@uetcodehub</a>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-facebook"></i>
                                <a href="http://www.facebook.com/keenthemes/">uetcodehub</a>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET MAIN -->
                    <!-- END MENU -->
                </div>
                <!-- END PORTLET MAIN -->

            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->

            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN PORTLET -->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Your Course</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row number-stats margin-bottom-30">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-left">
                                            <div class="stat-chart">
                                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                <div id="sparkline_bar"></div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title"> Total</div>
                                                <div class="number"> ?</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-right">
                                            <div class="stat-chart">
                                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                <div id="sparkline_bar2"></div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title"> Finished Rate</div>
                                                <div class="number"> ?</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-scrollable table-scrollable-borderless">
                                    <div class="scroller" style="height: 200px;" data-always-visible="1"
                                         data-rail-visible1="0" data-handle-color="#D7DCE2">
                                        <table class="table table-hover table-light">
                                            <thead>
                                            <tr class="uppercase">
                                                <th> Course</th>
                                                <th> Semester</th>
                                                <th> Remain</th>
                                                <th> Rate</th>
                                            </tr>
                                            </thead>
                                            <?php $courses = Auth::user()->Courses?>
                                            @foreach($courses as $course)
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"
                                                           class="primary-link">{{$course->courseName}}</a>
                                                    </td>
                                                    <td> {{$course->semester->semesterName}}</td>
                                                    <td> ?</td>
                                                    <td><span class="bold theme-font">?</span></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PORTLET -->
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN PORTLET -->
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Submission & Ranking</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab"> Submissions </a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab"> Ranking </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <!--BEGIN TABS-->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="scroller" style="height: 500px;" data-always-visible="1"
                                             data-rail-visible1="0" data-handle-color="#D7DCE2">
                                            <ul class="feeds">
                                                <?php $submissions = Auth::user()->AllSubmissions->take(10)?>
                                                @foreach($submissions as $submission)
                                                    <?php $submitDetail = $submission->detail()?>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    @if($submitDetail['resultCode'] == 'AC')
                                                                        <div class="label label-sm label-success">
                                                                            AC
                                                                        </div>
                                                                    @elseif($submitDetail['resultCode']=='')
                                                                        <div class="label label-sm label-info">
                                                                            PE
                                                                        </div>
                                                                    @else
                                                                        <div>
                                                                            <div class="label label-sm label-danger">
                                                                                {{$submitDetail['resultCode']}}
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc">
                                                                        Submission {{$submission->submitId}} -
                                                                        Exercise {{$submission->problem->problemId}}
                                                                        <br/>
                                                                        Score: {{$submission->resultScore}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2" style="width: 100px; margin-left:-100px;">
                                                            <div class="date">{{$submission->submitTime}}</div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_1_2">
                                        <?php $rankingTable = $statistic->getRankingTable() ?>
                                        <div class="scroller" style="height: 500px;" data-always-visible="1"
                                             data-rail-visible1="0" data-handle-color="#D7DCE2">
                                            <table class="table table-hover table-light">
                                                <thead>
                                                <tr class="uppercase">
                                                    <th width="20%"> Ranking</th>
                                                    <th width="50%"> Name</th>
                                                    <th width="30%"> Score</th>
                                                </tr>
                                                </thead>
                                                @foreach($rankingTable as $rank)
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:;"
                                                               class="primary-link">{{$rank->rank}}</a>
                                                        </td>
                                                        <td> {{$rank->username}}</td>
                                                        <td>
                                                            @if($rank->totalScore != -1)
                                                                {{$rank->totalScore}}
                                                            @else
                                                                #
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <!--END TABS-->
                            </div>
                            <!-- END PORTLET -->
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>

@endsection