<?php

$factory->define(App\Models\Course::class, function (Faker\Generator $faker) {
    return [
        'courseId' =>  $faker->randomNumber() ,
        'courseName' =>  $faker->word ,
        'createdUserId' =>  $faker->randomNumber() ,
        'semesterId' =>  $faker->randomNumber() ,
        'description' =>  $faker->word ,
        'isActive' =>  $faker->boolean ,
    ];
});

$factory->define(App\Models\Exam::class, function (Faker\Generator $faker) {
    return [
        'examId' =>  $faker->randomNumber() ,
        'examName' =>  $faker->word ,
        'courseId' =>  $faker->randomNumber() ,
        'availableFrom' =>  $faker->dateTimeBetween() ,
        'availableTo' =>  $faker->dateTimeBetween() ,
        'duration' =>  $faker->randomNumber() ,
        'isActive' =>  $faker->boolean ,
        'isFinish' =>  $faker->boolean ,
        'course_id' =>  function () {
             return factory(App\Models\Course::class)->create()->course_id;
        } ,
    ];
});

$factory->define(App\Models\Problem::class, function (Faker\Generator $faker) {
    return [
        'problemId' =>  $faker->randomNumber() ,
        'userId' =>  $faker->randomNumber() ,
        'content' =>  $faker->text ,
        'timelimit' =>  $faker->randomFloat() ,
        'defaultScore' =>  $faker->randomNumber() ,
        'tagValues' =>  $faker->text ,
        'isActive' =>  $faker->boolean ,
        'user_id' =>  function () {
             return factory(App\Models\User::class)->create()->user_id;
        } ,
    ];
});

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(App\Models\Semester::class, function (Faker\Generator $faker) {
    return [
        'semesterId' =>  $faker->randomNumber() ,
        'semesterName' =>  $faker->word ,
    ];
});

$factory->define(App\Models\Submission::class, function (Faker\Generator $faker) {
    return [
        'submitId' =>  $faker->randomNumber() ,
        'problemId' =>  $faker->randomNumber() ,
        'examId' =>  $faker->randomNumber() ,
        'courseId' =>  $faker->randomNumber() ,
        'userId' =>  $faker->randomNumber() ,
        'submitTime' =>  $faker->dateTimeBetween() ,
        'language' =>  $faker->word ,
        'sourceCode' =>  $faker->text ,
        'runningTime' =>  $faker->randomFloat() ,
        'result' =>  $faker->text ,
        'resultScore' =>  $faker->randomNumber() ,
        'isActive' =>  $faker->boolean ,
        'problem_id' =>  function () {
             return factory(App\Models\Problem::class)->create()->problem_id;
        } ,
    ];
});

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'userId' =>  $faker->randomNumber() ,
        'username' =>  $faker->userName ,
        'password' =>  bcrypt($faker->password) ,
        'firstname' =>  $faker->firstName ,
        'lastname' =>  $faker->lastName ,
        'email' =>  $faker->safeEmail ,
        'roleId' =>  $faker->randomNumber() ,
        'isActive' =>  $faker->boolean ,
    ];
});

