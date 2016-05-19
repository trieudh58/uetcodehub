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
}
