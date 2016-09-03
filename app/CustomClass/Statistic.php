<?php
/**
 * Created by PhpStorm.
 * User: hmduong
 * Date: 6/12/2016
 * Time: 4:08 PM
 */

namespace App\CustomClass{


    use Illuminate\Support\Facades\DB;

    class Statistic{

        public function getNumberOfCourse(){
            return \App\Models\Course::count();
        }

        public function getNumberOfMember(){
            return \App\Models\User::all()->where('roleId',4)->count();

        }

        public function getNumberOfExercise(){
            return \App\Models\Problem::count();
        }

        public function getTopCourses(){
            return \App\Models\Course::all()
                ->where('isActive',1)
                ->all();

        }

        public function getSampleExercise(){
            return \App\Models\Problem::orderBy(\DB::raw('RAND()'))->take(10)->get();

        }

        public function getRankingTable(){
            return DB::select(
                DB::raw(
                    'select rankingTable.userId, rankingTable.username, rankingTable.totalScore, rankingTable.rank from
                  (select userId, username, totalScore,
                    @curRank := IF(@prevRank = totalScore, @curRank, @incRank) AS rank, 
                    @incRank := @incRank + 1, 
                    @prevRank := totalScore
                  from
                    (select b.userId as userId, b.username as username, sum(b.maxScore) as totalScore
                    from 
                      (select users.userId, users.username, submissions.problemId, submissions.courseId, COALESCE(max(resultScore),-1) as maxScore
                      from submissions right join users on submissions.userId = users.userId
                      group by users.userId, problemId, courseId) as b
                    group by b.userId order by totalScore desc) as c,
                    (SELECT @curRank :=0, @prevRank := NULL, @incRank := 1) as r 
                  ) as rankingTable'
                )
            );
        }

    }

}

