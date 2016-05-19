<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('exams');
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('exam_id')->length(11)->index();
            $table->string('exam_name')->length(200);
            $table->integer('course_id')->length(11)->unsigned();
            $table->dateTime('available_from')->nullable();
            $table->dateTime('available_to')->nullable();
            $table->integer('duration')->length(11)->unsigned()->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_finish')->default(0);
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
        Schema::drop('exams');
    }
}
