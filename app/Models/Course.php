<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_id';

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'course_user');
    }

    public function createdUser()
    {
        $created_user = User::find($this->created_user_id);
        return $created_user->first_name.' '.$created_user->last_name;
    }

    public function problems()
    {
        return $this->belongsToMany('App\Models\Problem', 'course_problem')->withPivot('score_in_course', 'hard_level', 'is_active');
    }
    
    public function exams()
    {
        return $this->hasMany('App\Models\Exam');
    }
}
