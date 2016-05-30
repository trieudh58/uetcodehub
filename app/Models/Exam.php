<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $primaryKey = 'examId';

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function problems()
    {
        return $this->belongsToMany('App\Models\Problem', 'examProblems')->withPivot('scoreInExam', 'isActive');
    }
}
