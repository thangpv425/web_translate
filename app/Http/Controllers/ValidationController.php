<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keyword;

class ValidationController extends Controller
{
    public function checkUniqueKeyword(Request $request)
    {
    	if (Keyword::where('keyword', $request->keyword)->first()  != null) {
    		echo true;
    	} else {
    		echo false;
    	}
    }
}
