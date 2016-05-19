<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement("SET foreign_key_checks = 0");

        DB::table('users')->truncate();
        $user = new User();
        $user->username = '13020643';
        $user->password = bcrypt('123456');
        $user->first_name = 'Admin';
        $user->last_name = '';
        $user->save();

        $user = new User();
        $user->username = '13020642';
        $user->password = bcrypt('123456');
        $user->first_name = 'Dang';
        $user->last_name = 'Trieu';
        $user->save();

        DB::table('courses')->truncate();
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('courses')->insert([
                'course_name' => $faker->word,
                'created_user_id' => 1,
                'semester_id' => 1,
                'description' => $faker->paragraph,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        DB::table('course_user')->truncate();
        foreach (range(1, 5) as $index) {
            DB::table('course_user')->insert([
                'course_id' => $index,
                'user_id' => 2
            ]);
        }

        DB::table('problems')->truncate();
        foreach (range(1, 10) as $index) {
            DB::table('problems')->insert([
                'content' => $faker->text,
                'time_limit' => 2.0,
            ]);
        }
        DB::table('course_problem')->truncate();
        foreach (range(1, 5) as $index) {
            DB::table('course_problem')->insert([
                'course_id' => 1,
                'problem_id' => $index,
                'hard_level' => 1,
                'score_in_course' => 20
            ]);
        }
        foreach (range(6, 10) as $index) {
            DB::table('course_problem')->insert([
                'course_id' => 2,
                'problem_id' => $index,
                'hard_level' => 2,
                'score_in_course' => 20
            ]);
        }

        DB::table('submissions')->truncate();
        DB::table('submissions')->insert([
            'problem_id' => 1,
            'course_id' => 1,
            'user_id' => 2,
            'submit_time' => \Carbon\Carbon::now(),
            'language' => 'C++',
            'source_code' => '#include<iostream>

using namespace std;

int main(){
	int i;
	//while(1)
	cin >> i;
	cout << i;
	return 0;
}',
        ]);
        DB::table('submissions')->insert([
            'problem_id' => 2,
            'course_id' => 1,
            'user_id' => 2,
            'submit_time' => \Carbon\Carbon::now(),
            'language' => 'C++',
            'source_code' => '#include<iostream>

using namespace std;

int main(){
	int i;
	//while(1)
	cin >> i;
	cout << i;
	return 0;
}',
        ]);
        foreach (range(3, 5) as $index) {
            DB::table('submissions')->insert([
                'problem_id' => $index,
                'course_id' => 1,
                'user_id' => 2,
                'submit_time' => \Carbon\Carbon::now(),
                'language' => 'C++',
                'source_code' => $faker->text,
            ]);
        }
        foreach (range(6, 10) as $index) {
            DB::table('submissions')->insert([
                'problem_id' => $index,
                'course_id' => 2,
                'user_id' => 2,
                'submit_time' => \Carbon\Carbon::now(),
                'language' => 'C++',
                'source_code' => $faker->text,
            ]);
        }

        DB::table('exams')->truncate();
        foreach (range(1, 10) as $index) {
            DB::table('exams')->insert([
                'exam_name' => $faker->name,
                'course_id' => $index,
                'available_from' => $faker->dateTime,
                'available_to' => $faker->dateTime,
                'duration' => 90,
            ]);
        }

        DB::table('exam_problem')->truncate();
        foreach (range(1, 5) as $index) {
            DB::table('exam_problem')->insert([
                'exam_id' => 1,
                'problem_id' => $index,
                'score_in_exam' => 20
            ]);
        }
    }
}
