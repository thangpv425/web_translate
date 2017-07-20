<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\meaning;

class userController extends Controller
{
    public function keyWordList(){
    	$meaning= meaning::all();
    	return view('admin.keyWordList',['meaning'=>$meaning]);
    }
}
