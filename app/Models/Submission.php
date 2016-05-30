<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $primaryKey = 'submissionId';

    public function problem()
    {
        return $this->belongsTo('App\Models\Problem');
    }
}
