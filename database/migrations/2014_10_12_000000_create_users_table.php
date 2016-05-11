<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id')->length(11)->index();
            $table->string('username')->length(200);
            $table->string('password')->length(200);
            $table->string('first_name')->length(100)->nullable();
            $table->string('last_name')->length(100)->nullable();
            $table->string('email')->length(200)->nullable();
            $table->integer('role_id')->length(11)->unsigned()->nullable();
            $table->boolean('is_active')->default(1);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
