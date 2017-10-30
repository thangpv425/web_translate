<?php

namespace App\Http\Controllers;

use Validator;
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
    /**
     * ajax data for translate request
     * @param  TranslateRequest $request [description]
     * @return [json]                    [meanings group by type + best meaning]
     */
    public function postTranslate(TranslateRequest $request)
    {
    	$meanings = $this->keyword->hasMeaningsGroupByType(strtolower($request->text), $request->lang)->toArray();
    	$meanings['best'] = $this->keyword->bestMeaning(strtolower($request->text), $request->lang);
    	if ($meanings['best'] == '') {
    		return response()->json(null);
    	}
    	return response()->json($meanings);
    }

    /**
     * [FunctionName description]
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @internal param string $value [description]
     */
    public function postDetailMeaning(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keyword' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Request is invalid.',
                'alert-type' => 'error'
            );
            return response()->json($notification);
        }
        $key = strtolower($request->keyword);
        $meanings[VIETNAMESE] = $this->keyword->hasMeaningsGroupByType($key, VIETNAMESE)->toArray();
        $meanings[ENGLISH] = $this->keyword->hasMeaningsGroupByType($key, ENGLISH)->toArray();
        return response()->json($meanings);
    }
}
