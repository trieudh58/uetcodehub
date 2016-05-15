<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseProblemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_problem', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->length(11);
            $table->integer('problem_id')->length(11);
            $table->integer('hard_level')->length(11)->nullable();
            $table->integer('score_in_course')->length(11);
            $table->boolean('is_active')->default(1);
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
        Schema::drop('course_problem');
    }
}
