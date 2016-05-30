<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
