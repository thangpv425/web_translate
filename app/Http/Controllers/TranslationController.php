<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TranslateRequest;
use App\Keyword;
use App\Repositories\Interfaces\KeywordRepositoryInterface;
class TranslationController extends Controller
{
	protected $keyword;

    public function __construct(KeywordRepositoryInterface $keyword)
    {
        $this->keyword = $keyword;
    }
    public function index()
    {
    	return view('translate.index');
    }

    public function postTranslate(TranslateRequest $request)
    {
    	$meanings = $this->keyword->hasMeaningsGroupByType(strtolower($request->text), $request->lang)->toArray();
    	$meanings['best'] = $this->keyword->bestMeaning(strtolower($request->text), $request->lang);
    	if ($meanings['best'] == '') {
    		return response()->json(null);
    	}
    	return response()->json($meanings);
    }
}
