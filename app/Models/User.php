<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'userId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname', 'lastname', 'email', 'password',
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
        return $this->firstName.' '.$this->lastName;
    }
    
    public function problems()
    {
        return $this->hasMany('App\Models\Problem');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'courseusers', 'userId', 'courseId');
    }

    public function submissions($courseId, $problemId){
        $condition = ['courseId' => $courseId, 'problemId' => $problemId];
        return
            $this->hasMany('App\Models\Submission', 'userId')
                 ->where($condition)->orderBy('submitId', 'desc')->get();
    }

    /* Remove remember token */
    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }

}
