<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array(
            array('id' => '1', 'name' => 'hr', 'email' => 'hr@hr.com', 'password' => \Hash::make('password'), 'job_title'=>'hr', 'status' => 1 , 'is_hr' => 1),
            array('id' => '2', 'name' => 'user', 'email' => 'user@user.com', 'password' => \Hash::make('password'), 'job_title' => 'call_center', 'status' => 1 , 'is_hr' => 0),

        );
        User::insert($data);

    }
}
