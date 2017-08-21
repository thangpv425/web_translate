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
        	['keyword'=>'おはよう', 'status'=> '1'],
        	['keyword'=>'みず', 'status'=> '1'],
        	['keyword'=>'車', 'status'=> '1'],
        	['keyword'=>'まち', 'status'=> '1'],
        	['keyword'=>'国', 'status'=> '1'],
        	['keyword'=>'好き', 'status'=> '1'],
        	['keyword'=>'起きる', 'status'=> '1'],
        	['keyword'=>'行く', 'status'=> '1'],
        	['keyword'=>'赤い', 'status'=> '1'],
        	]);

        DB::table('wt_meaning')->insert([
        	['keyword_id'=>'1', 'meaning'=>'xin chào', 'index'=>'1', 'status'=>'1', 'language'=>'0', 'type'=>'1'],
        	['keyword_id'=>'1', 'meaning'=>'hello', 'index'=>'2', 'status'=>'1', 'language'=>'1', 'type'=>'1'],
        	['keyword_id'=>'2', 'meaning'=>'nước', 'index'=>'1', 'status'=>'1', 'language'=>'0', 'type'=>'0'],
        	['keyword_id'=>'2', 'meaning'=>'water', 'index'=>'2', 'status'=>'1', 'language'=>'1', 'type'=>'0'],
        	['keyword_id'=>'3', 'meaning'=>'xe hơi', 'index'=>'1', 'status'=>'1', 'language'=>'0', 'type'=>'0'],
        	['keyword_id'=>'3', 'meaning'=>'ô tô', 'index'=>'2', 'status'=>'1', 'language'=>'0', 'type'=>'0'],
        	['keyword_id'=>'3', 'meaning'=>'car', 'index'=>'3', 'status'=>'1', 'language'=>'1', 'type'=>'0'],
        	['keyword_id'=>'4', 'meaning'=>'thành phố', 'index'=>'1', 'status'=>'1', 'language'=>'0', 'type'=>'0'],
        	['keyword_id'=>'4', 'meaning'=>'city', 'index'=>'2', 'status'=>'1', 'language'=>'1', 'type'=>'0'],
        	['keyword_id'=>'5', 'meaning'=>'country', 'index'=>'1', 'status'=>'1', 'language'=>'1', 'type'=>'0'],
        	['keyword_id'=>'5', 'meaning'=>'đất nước', 'index'=>'2', 'status'=>'1', 'language'=>'0', 'type'=>'0'],
        	['keyword_id'=>'5', 'meaning'=>'quê hương', 'index'=>'3', 'status'=>'1', 'language'=>'0', 'type'=>'0'],
        	['keyword_id'=>'6', 'meaning'=>'yêu', 'index'=>'1', 'status'=>'1', 'language'=>'0', 'type'=>'2'],
        	['keyword_id'=>'6', 'meaning'=>'thích', 'index'=>'2', 'status'=>'1', 'language'=>'0', 'type'=>'2'],
        	['keyword_id'=>'6', 'meaning'=>'yêu', 'index'=>'3', 'status'=>'1', 'language'=>'0', 'type'=>'1'],
        	['keyword_id'=>'6', 'meaning'=>'thích', 'index'=>'4', 'status'=>'1', 'language'=>'0', 'type'=>'1'],
        	['keyword_id'=>'6', 'meaning'=>'like', 'index'=>'5', 'status'=>'1', 'language'=>'1', 'type'=>'1'],
        	['keyword_id'=>'6', 'meaning'=>'love', 'index'=>'6', 'status'=>'1', 'language'=>'1', 'type'=>'1'],
        	['keyword_id'=>'7', 'meaning'=>'ngủ dậy', 'index'=>'1', 'status'=>'1', 'language'=>'0', 'type'=>'1'],
        	['keyword_id'=>'7', 'meaning'=>'get up', 'index'=>'2', 'status'=>'1', 'language'=>'1', 'type'=>'1'],
        	['keyword_id'=>'7', 'meaning'=>'wake up', 'index'=>'3', 'status'=>'1', 'language'=>'1', 'type'=>'1'],
        	['keyword_id'=>'8', 'meaning'=>'đi', 'index'=>'1', 'status'=>'1', 'language'=>'0', 'type'=>'1'],
        	['keyword_id'=>'8', 'meaning'=>'go', 'index'=>'2', 'status'=>'1', 'language'=>'1', 'type'=>'1'],
        	['keyword_id'=>'9', 'meaning'=>'đỏ', 'index'=>'1', 'status'=>'1', 'language'=>'0', 'type'=>'2'],
        	['keyword_id'=>'9', 'meaning'=>'red', 'index'=>'2', 'status'=>'1', 'language'=>'1', 'type'=>'2'],
        	
        	]);

        DB::table('roles')->insert([
            ['id' => '1', 'slug' => 'admin', 'name' => 'Admin', 'permissions' => ''],
            ['id' => '2', 'slug' => 'manager', 'name' => 'Manager', 'permissions' => ''],
            ['id' => '3', 'slug' => 'user', 'name' => 'User', 'permissions' => ''],
            ['id' => '4', 'slug' => 'guest', 'name' => 'Guest', 'permissions' => ''],
        ]);
    }
}
