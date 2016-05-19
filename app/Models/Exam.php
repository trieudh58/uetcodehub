<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $primaryKey = 'exam_id';

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function problems()
    {
        return $this->belongsToMany('App\Models\Problem', 'exam_problem')->withPivot('score_in_exam', 'is_active');
    }
}
