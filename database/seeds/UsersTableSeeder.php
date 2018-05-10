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
        DB::table('users')->insert(array(
        	[
        		'name' => 'Hegun',
        		'email' => 'Hegun@gmail.com',
        		'password' => bcrypt('180188'),
        		'foto' => 'user.png',
        		'level' => 1
        	],
        	[
        		'name' => 'Ratna Kwok',
        		'email' => 'Ratna@gmail.com',
        		'password' => bcrypt('xuxu'),
        		'foto' => 'user.png',
        		'level' => 2
        	]
        ));
    }
}
