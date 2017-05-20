<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creating some different tasks in database
        DB::table('tasks')->insert([
            'user_id' => 1,
            'name' => 'Task Number 1',
            'description' => 'This is a description of task 1.',
            'state' => 'new',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tasks')->insert([
            'user_id' => 1,
            'name' => 'Task Number 2',
            'description' => 'This is a description of task 2.',
            'state' => 'in-progress',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tasks')->insert([
            'user_id' => 1,
            'name' => 'Task Number 3',
            'description' => 'This is a description of task 3.',
            'state' => 'finished',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('tasks')->insert([
            'user_id' => 2,
            'name' => 'Task Number 4',
            'description' => 'This is a description of task 4.',
            'state' => 'new',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tasks')->insert([
            'user_id' => 2,
            'name' => 'Task Number 5',
            'description' => 'This is a description of task 5.',
            'state' => 'in-progress',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tasks')->insert([
            'user_id' => 2,
            'name' => 'Task Number 6',
            'description' => 'This is a description of task 6.',
            'state' => 'finished',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
