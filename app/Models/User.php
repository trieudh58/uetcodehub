<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullName()
    {
        return $this->first_name.' '.$this->last_name;
    }
    
    public function problems()
    {
        return $this->hasMany('App\Models\Problem');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'course_user');
    }
}
