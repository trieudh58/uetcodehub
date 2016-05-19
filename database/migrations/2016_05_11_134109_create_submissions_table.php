<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('submissions');
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('submission_id')->length(11)->index();
            $table->integer('problem_id')->length(11)->unsigned();
            $table->integer('exam_id')->length(11)->unsigned()->nullable();
            $table->integer('course_id')->length(11)->unsigned()->nullable();
            $table->integer('user_id')->length(11)->unsigned();
            $table->timestamp('submit_time');
            $table->string('language')->length(20)->nullable();
            $table->text('source_code')->nullable();
            $table->float('running_time')->nullable();
            $table->string('result')->nullable();
            $table->integer('result_score')->length(11)->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('problem_id')->references('problem_id')->on('problems')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('submissions');
    }
}
