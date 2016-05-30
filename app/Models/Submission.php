<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $primaryKey = 'submitId';
    public $timestamps  = false;

    public function problem()
    {
        return $this->belongsTo('App\Models\Problem', 'problemId');
    }
}
