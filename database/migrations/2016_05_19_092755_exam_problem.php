<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExamProblem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_problem', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_id')->length(11);
            $table->integer('problem_id')->length(11);
            $table->integer('score_in_exam')->length(11);
            $table->boolean('is_active')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exam_problem');
    }
}
