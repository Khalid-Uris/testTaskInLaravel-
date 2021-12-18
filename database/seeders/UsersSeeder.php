<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_task')->insert([
            'name'=>'Shahrukh',
            'email'=>'shahrukh@gmail.com',
            'phone_no'=>'123456789',
            'Image'=>'',
            'password'=>'shahrukh'
        ]);
    }
}
