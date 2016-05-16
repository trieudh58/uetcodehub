<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $primaryKey = 'problem_id';
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'course_problem');
    }

    public function submissions()
    {
        return $this->hasMany('App\Models\Submission');
    }
}
