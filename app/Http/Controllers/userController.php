<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\meaning;
use App\keyword;

class userController extends Controller
{
    public function keywordList(){
    	$meaning = meaning::all();
        $keyword = keyword::all();
    	return view('admin.keyWordList',[
            'meaning'=>$meaning,
            'keyword'=>$keyword
                ]);
    }
    public function keywordAdd(){
        return view('admin.keyWordAdd');
    }
}