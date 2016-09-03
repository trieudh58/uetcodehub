<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Problem extends Model
{
    protected $primaryKey = 'problemId';
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'courseProblems', 'courseId', 'problemId');
    }

    public function submissions()
    {
        return $this->hasMany('App\Models\Submission', 'submitId');
    }

    public function exams()
    {
        return $this->belongsToMany('App\Models\Exam', 'examProblem')->withPivot('scoreInExam', 'isActive');
    }

    public function numberOfSubmitedUser(){
        $row = DB::select(
            DB::raw(
             'select problemId, count(userId) as numOfUser from(
                select problems.problemId, submissions.userId, max(submissions.resultScore) as userScore, submissions.courseId, problems.defaultScore
                from problems left join submissions on problems.problemId = submissions.problemId
                group by problems.problemId, submissions.userId) as s
              group by problemId having problemId = '.$this->problemId)
        );
        return $row[0]->numOfUser;
    }

    public function numberOfFinishedUser(){
        $row = DB::select(
            DB::raw(
                'select problems.problemId, count(s.userId) as numOfUser from(
                  select problems.problemId, submissions.userId, max(submissions.resultScore) as userScore, submissions.courseId, problems.defaultScore
                  from problems left join submissions on problems.problemId = submissions.problemId
                  group by problems.problemId, submissions.userId having userScore = defaultScore) as s 
                  right join problems on s.problemId = problems.problemId
                group by problems.problemId having problemId = '.$this->problemId)
        );
        return $row[0]->numOfUser;
    }

    public function getScoreOfUser($courseId){
        $row = DB::select(
            DB::raw(
                'select problemId, courseId, userId, max(resultScore) as score
                 from submissions where userid = '.Auth::user()->userId.' and courseId = '.$courseId. ' and problemId = '.$this->problemId
            )
        );
        return $row[0]->score;
    }
}
