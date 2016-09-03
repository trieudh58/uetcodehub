<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    protected $primaryKey = 'userId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname', 'lastname', 'email', 'password', 'roleId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function role(){
        return $this->hasOne('App\Models\Userrole', 'roleId');
    }

    public function problems()
    {
        return $this->hasMany('App\Models\Problem');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'courseusers', 'userId', 'courseId');
    }

    public function submissions($courseId, $problemId)
    {
        $condition = ['courseId' => $courseId, 'problemId' => $problemId];
        return
            $this->hasMany('App\Models\Submission', 'userId')
                ->where($condition)->orderBy('submitId', 'desc')->get();
    }

    public function allSubmissions()
    {
        return $this->hasMany('App\Models\Submission', 'userId')->orderBy('submitId', 'desc');
    }

    public function totalScore()
    {
        $tbl = $this
            ->hasMany('App\Models\Submission', 'userId')
            ->groupBy('courseId', 'problemId')
            ->get(['submissions.submitId', \DB::raw('max(resultScore) as maxScore')])
            ->sum('maxScore');
        return $tbl;
    }

    protected $rankingTable;
    public function calculateRanking(){
        $this->rankingTable = DB::select(
            DB::raw(
                'select rankingTable.userId, rankingTable.totalScore, rankingTable.rank from
                  (select userId, totalScore,
                    @curRank := IF(@prevRank = totalScore, @curRank, @incRank) AS rank, 
                    @incRank := @incRank + 1, 
                    @prevRank := totalScore
                  from
                    (select b.userId as userId, sum(b.maxScore) as totalScore
                    from 
                      (select users.userId, submissions.problemId, submissions.courseId, COALESCE(max(resultScore),-1) as maxScore
                      from submissions right join users on submissions.userId = users.userId
                      group by users.userId, problemId, courseId) as b
                    group by b.userId order by totalScore desc) as c,
                    (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) as r 
                  ) as rankingTable'
            )
        );
    }

    public function currentRanking()
    {
        $currentRank = DB::select(
            DB::raw(
                'select rankingTable.userId, rankingTable.totalScore, rankingTable.rank from
                  (select userId, totalScore,
                    @curRank := IF(@prevRank = totalScore, @curRank, @incRank) AS rank, 
                    @incRank := @incRank + 1, 
                    @prevRank := totalScore
                  from
                    (select b.userId as userId, sum(b.maxScore) as totalScore
                    from 
                      (select users.userId, submissions.problemId, submissions.courseId, COALESCE(max(resultScore),-1) as maxScore
                      from submissions right join users on submissions.userId = users.userId
                      group by users.userId, problemId, courseId) as b
                    group by b.userId order by totalScore desc) as c,
                    (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) as r 
                  ) as rankingTable where userId = '.$this->userId
            )
        );
        return $currentRank[0]->rank;

    }

    public function totalUserNumber(){
        return $this->get()->count();
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
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

}
