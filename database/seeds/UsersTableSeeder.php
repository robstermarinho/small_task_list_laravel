<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creating 2 users. One of the is the admin user
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => 'admin@scopic.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'first_name' => 'Robert',
            'last_name' => 'Marinho',
            'email' => 'robstermarinho@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'regular',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
