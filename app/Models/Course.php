<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'courseId';

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'courseusers');
    }

    public function createdUser()
    {
        $created_user = User::find($this->createdUserId);
        return $created_user->firstname.' '.$created_user->lastname;
    }

    public function problems()
    {
        return $this->belongsToMany('App\Models\Problem', 'courseproblems', 'courseId', 'problemId')->withPivot('scoreInCourse', 'hardLevel', 'isActive');
    }
    
    public function exams()
    {
        return $this->hasMany('App\Models\Exam');
    }
}
