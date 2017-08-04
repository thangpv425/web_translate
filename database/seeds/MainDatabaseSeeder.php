<?php

use Illuminate\Database\Seeder;

class MainDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wt_keyword')->insert([
        	['keyword'=>'hello', 'status'=> '1'],
        	['keyword'=>'hi', 'status'=> '1'],
        	['keyword'=>'strong', 'status'=> '1'],
        	['keyword'=>'name', 'status'=> '1'],
        	['keyword'=>'handsome', 'status'=> '1'],
        	['keyword'=>'outside', 'status'=> '1'],
        	['keyword'=>'city', 'status'=> '1'],
        	['keyword'=>'country', 'status'=> '1'],
        	['keyword'=>'fuck', 'status'=> '1'],
        	]);

        DB::table('wt_meaning')->insert([
        	['keyword_id'=>'1', 'meaning'=>'xin chao', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'2', 'meaning'=>'chao', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'3', 'meaning'=>'khoe', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'4', 'meaning'=>'ten', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'5', 'meaning'=>'dap chai', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'6', 'meaning'=>'dap chai', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'7', 'meaning'=>'ben ngoai', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'8', 'meaning'=>'dat nuoc', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'9', 'meaning'=>'d**', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'8', 'meaning'=>'mot nghia khac cua country', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	
        	]);

        DB::table('roles')->insert([
            ['id' => '1', 'slug' => 'admin', 'name' => 'Admmin', 'permissions' => ''],
            ['id' => '2', 'slug' => 'manager', 'name' => 'Manager', 'permissions' => ''],
            ['id' => '3', 'slug' => 'user', 'name' => 'User', 'permissions' => ''],
            ['id' => '4', 'slug' => 'guest', 'name' => 'Guest', 'permissions' => ''],
        ]);
    }
}
