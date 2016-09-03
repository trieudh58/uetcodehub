@extends('layouts.app')

@section('extendedHead')

@endsection

@section('pageScript')


    <script src="{{URL::asset('assets/global/plugins/counterup/jquery.waypoints.min.js')}}"
            type="text/javascript"></script>
    <script src="{{URL::asset('assets/global/plugins/counterup/jquery.counterup.min.js')}}"
            type="text/javascript"></script>


@endsection

@section('script')
    <script type="text/javascript">
        $('#btn').click(function () {
            toastr.success("Gnome & Growl type non-blocking notifications", "Toastr Notifications");
        });
    </script>
@endsection

@section('pageTitle')
    Homepage
@endsection

@section('content')
    @if(!Auth::guest())
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="" data-value="">{{Auth::user()->courses()->count()}}</span>
                        </div>
                        <div class="desc"> Total courses</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"
                                  data-value="{{Auth::user()->allSubmissions()->count()}}">0</span>
                        </div>
                        <div class="desc"> Total Submissions</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{Auth::user()->totalScore()}}">0</span>
                        </div>
                        <div class="desc"> Total Score</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">

                            <span data-counter="counterup" data-value="{{Auth::user()->currentRanking()}}">89</span>
                        </div>
                        <div class="desc"> Ranking</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-briefcase fa-icon-medium"></i>
                    </div>
                    <div class="details">
                        <div class="number"> {{$statistic->getNumberOfExercise()}}</div>
                        <div class="desc"> Total Exercises</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number"> {{$statistic->getNumberOfMember()}}</div>
                        <div class="desc"> Total Members</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-group fa-icon-medium"></i>
                    </div>
                    <div class="details">
                        <div class="number"> {{$statistic->getNumberOfCourse()}}</div>
                        <div class="desc"> Total Courses</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-blue"></i>
                            <span class="caption-subject font-blue bold uppercase">Some Courses</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrollDiv"
                             style="position: relative; overflow: hidden; width: auto; height: 300px;">
                            <div class="scroller" style="height: 300px; overflow: hidden; width: auto;"
                                 data-always-visible="1" data-rail-visible="0" data-initialized="1">
                                <div class="table-responsive">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> Course Name </th>
                                            <th> Semester </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $courses = $statistic->getTopCourses()?>
                                        @foreach($courses as $course)
                                        <tr>
                                            <td>{{$course->courseName}}</td>
                                            <td>{{$course->Semester->semesterName}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    @endif

@endsection
