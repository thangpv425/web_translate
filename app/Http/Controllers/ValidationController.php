<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keyword;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\KeywordRepositoryInterface;

class ValidationController extends Controller
{
	protected $keyword;

    public function __construct(KeywordRepositoryInterface $keyword)
    {
        $this->keyword = $keyword;
    }

    public function checkUniqueKeyword(Request $request)
    {
    	$isExist = false;
    	$result = $this->keyword->findByKeyword(strtolower($request->keyword));
    	if (!empty($result)) {
    		$isExist = true;
    	}
    	return response()->json(['isExist'=>$isExist]);
    }
}
