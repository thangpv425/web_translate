<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	['slug'=>'admin', 'name'=> 'Admin'],
        	['slug'=>'user', 'name'=> 'User'],
        	]);

        
		// DB::table('users')->insert([
		// 	['email'=>'user@gmail.com', 'password'=>bcrypt('123456'), 'first_name'=>'User', 'last_name'=>'Tran Thi'],
		// 	['email'=>'admin@gmail.com', 'password'=>bcrypt('123456'), 'first_name'=>'Admin', 'last_name'=>'Nguyen Thi'],
		// 	]);

		// DB::table('role_users')->insert([
  //       	['user_id'=>1, 'role_id'=> '2'],
  //       	['user_id'=>2, 'role_id'=> '1'],
  //       	]);  
    }
}
