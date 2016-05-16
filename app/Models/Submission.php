<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $primaryKey = 'submission_id';

    public function problem()
    {
        return $this->belongsTo('App\Models\Problem');
    }
}
