<?php

use Illuminate\Database\Seeder;

class KeywordMeaningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wt_keyword')->insert([
        	['value'=>'hello', 'status'=> '1'],
        	['value'=>'hi', 'status'=> '1'],
        	['value'=>'strong', 'status'=> '1'],
        	['value'=>'name', 'status'=> '1'],
        	['value'=>'handsome', 'status'=> '1'],
        	['value'=>'outside', 'status'=> '1'],
        	['value'=>'city', 'status'=> '1'],
        	['value'=>'country', 'status'=> '1'],
        	['value'=>'fuck', 'status'=> '1'],
        	]);

        DB::table('wt_meaning')->insert([
        	['keyword_id'=>'3', 'value'=>'xin chao', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'4', 'value'=>'chao', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'5', 'value'=>'khoe', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'6', 'value'=>'ten', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'7', 'value'=>'dap chai', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'8', 'value'=>'thanh pho', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'9', 'value'=>'dat nuoc', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'10', 'value'=>'d**', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	['keyword_id'=>'9', 'value'=>'mot nghia khac cua country', 'index'=>'1', 'status'=>'1', 'language'=>'1'],
        	
        	]);
    }
}
