<nav class="navbar navbar-default navbar-static-top navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="" class="navbar-brand">UET Code Hub</a>
    </div>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="nav navbar-nav navbar-right" style="margin-right:20px">
        <li><a href="{{ route('courses.enrolled')}}">Lớp của tôi</a></li>
        <li><a href="{{ route('courses.index')}}">Khóa học</a></li>
        <li><a href="{{ route('exams.index')}}">Kì thi</a></li>
      </ul>
    </div>
  </div>
</nav>