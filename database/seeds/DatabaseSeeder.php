<?php

use App\Models\User;
use Illuminate\Database\Seeder;

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
        $user = new User();
        $user->username = '13020642';
        $user->password = bcrypt('123456');
        $user->first_name = 'Dang';
        $user->last_name = 'Trieu';
        $user->save();
    }
}
