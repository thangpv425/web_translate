<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImproveMeaningRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meaning;
use App\Keyword;
use App\KeywordTemp;
use App\MeaningTemp;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Validator;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserController extends Controller
{
    // protected $user;
    // public function __construct(UserRepositoryInterface $user)
    // {
    //     $this->user = $user;
    // }

    public function view() {
        $user = Sentinel::getUser();
        return view('user.view')->with('user', $user);
    }

    public function edit() {
        $user = Sentinel::getUser();
        return view('user.edit')->with('user', $user);
    }

    public function update(\App\Http\Requests\CheckUpdateInfoRequest $request) {
        try {
            $user = Sentinel::getUser();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;

            DB::beginTransaction();
            $user->update();
            DB::commit();

            $notification = 'You have successfully update your information.';
        } catch (\Exception $e) {
            DB::rollback();
            $notification = 'Something went wrong!';
            return redirect('user/edit')->withErrors($notification);
        }
        return redirect('user/edit')->with('notification', $notification);
    }

    public function addKeyword() {
        return view('user.keywordAdd');
    }

    public function processAddKeyword(Request $request) {
        try {
            $user = Sentinel::getUser();
            $dataMeaning = array();

            DB::beginTransaction();
            //save keyword in keyword table to get id
            $keyword = Keyword::create([
                        'keyword' => $request->keyword,
                        'status' => IN_QUEUE
            ]);
            //save keyword in keywordTemp table 
            $keyword_temp = KeywordTemp::create([
                        'opCode' => ADD,
                        'user_id' => $user->id,
                        'old_keyword_id' => $keyword->id,
                        'new_keyword' => $request->keyword,
                        'comment' => $request->comment,
                        'status' => IN_QUEUE
            ]);
            //save meaning in meaningTemp table
            foreach ($request->translate as $key => $value) {
                $dataMeaning[] = array(
                    'opCode' => ADD,
                    'user_id' => $user->id,
                    'keyword_id' => $keyword->id,
                    'new_meaning' => $value['meaning'],
                    'index' => $key,
                    'language' => $value['language'],
                    'comment' => $request->comment,
                    'type' => $value['type'],
                    'status' => IN_QUEUE
                );
            }
            foreach ($dataMeaning as $key => $value) {
                $meaning = MeaningTemp::create($value);
            }
            DB::commit();

            $notification = 'You have successfully add new keyword.';
        } catch (\Exception $e) {
            DB::rollback();
            $notification = 'Something went wrong!';
            throw $e;
            return redirect('user/add/keyword')->withErrors($notification);
        }
        return redirect('user/history')->with('notification', $notification);
    }

    public function showContributeHistory() {
        $user = Sentinel::getUser();
        $id = $user->id;
        $dataKeyword = KeywordTemp::where('user_id', $user->id)->get();
        $dataMeaning = MeaningTemp::where('user_id', $user->id)->get();
        return view('user.contributeHistory', ['dataKeyword' => $dataKeyword, 'dataMeaning' => $dataMeaning]);
    }

    public function deleteKeywordContribute($id) {
        //delete in wt_keyword_temp, wt_meaning_temp and wt_keyword
        try {
            $keywordtmp = KeywordTemp::find($id);
            $keyword = Keyword::find($keywordtmp->old_keyword_id);
            $meaningtmps = MeaningTemp::where('keyword_id', $keyword->id);

            DB::beginTransaction();
            $keywordtmp->delete();
            foreach ($meaningtmps as $meaningtmp) {
                $meaningtmp->delete();
            }
            //if this keyword is added by user
            if ($keyword->status == IN_QUEUE) {
                $keyword->forceDelete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('user/history');
    }

    public function deleteMeaningContribute($id) {
        //delete in wt_meaning_temp and delete keyword if there are not any meaning
        try {
            $meaningtmp = MeaningTemp::find($id);
            $keywordtmp = KeywordTemp::where('old_keyword_id', $meaningtmp->keyword_id);
            $keyword = Keyword::find($meaningtmp->keyword_id);

            DB::beginTransaction();
            $meaningtmp->delete();

            $numberOfMeanings = MeaningTemp::where('keyword_id', $meaningtmp->keyword_id)->count();
            //delete keyword            
            if ($numberOfMeanings == 0) {
                $keywordtmp->delete();
                if ($keyword->status == IN_QUEUE) {
                    $keyword->forceDelete();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('user/history');
    }

    public function improveMeaning(ImproveMeaningRequest $request)
    {
        // dd($request->all());
        try {
            $oldMeaning = Meaning::find($request->old_meaning_id);
            $newMeaning = array(
                'opCode' => EDIT,
                'keyword_id' => $oldMeaning->keyword_id,
                'user_id' => Sentinel::getUser()->id,
                'old_meaning_id' => $oldMeaning->id,
                'new_meaning' => $request->new_meaning,
                'language' => $oldMeaning->language,
                'type' => $oldMeaning->type,
                'index' => $oldMeaning->index,
                'comment' => $request->comment,
                'status' => IN_QUEUE,
            );
            DB::beginTransaction();
            MeaningTemp::create($newMeaning);
            DB::commit();
            $notification = array(
                'message' => 'Request has been sent.', 
                'alert-type' => 'success'
            );
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Some thing wrong.',
                'alert-type' => 'error',
            );
        }
        return response()->json($notification);
    }
}
