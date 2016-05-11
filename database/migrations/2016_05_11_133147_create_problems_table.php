<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('problems');
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('problem_id')->length(11)->index();
            $table->integer('user_id')->length(11)->unsigned()->nullable();
            $table->text('content')->nullable();
            $table->float('time_limit')->nullable();
            $table->integer('default_score')->length(11)->nullable();
            $table->text('tag_values')->nullable();
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
        Schema::drop('problems');
    }
}
