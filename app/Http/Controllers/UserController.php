<?php

namespace App\Http\Controllers;

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

class UserController extends Controller {

    // protected $user;
    // public function __construct(UserRepositoryInterface $user)
    // {
    //     $this->user = $user;
    // }

    public function view($id = NULL) {
        $user = User::find($id);
        return view('user.view')->with('user', $user);
    }

    public function edit($id = NULL) {
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
    }

    public function update(\App\Http\Requests\CheckUpdateInfoRequest $request, $id) {
        try{
//            $validator = Validator::make($request->all(), [
//                'first_name' => 'required|min:1|max:32|regex:/(^[A-Za-z0-9 ]+$)+/',
//                'last_name' => 'required|min:1|max:32|regex:/[^\!-\@\[-\_\{-\}]+$/u'
//                    ], [
//                'first_name.required' => 'Please enter first name',
//                'last_name.required' => 'Please enter last name',
//                'first_name.min' => 'The length of first name is bigger than 1',
//                'last_name.min' => 'The length of last name is bigger than 1',
//                'first_name.regex' => 'Only accept lowercase or uppercase letters',
//                'last_name.regex' => 'Only accept lowercase or uppercase letters'
//            ]);
//        if ($validator->fails()) {
//            return redirect('user/edit/' . $id)
//                            ->withErrors($validator)
//                            ->withInput();
//        }

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        DB::beginTransaction(); 
        $user->update();
        DB::commit();
        
        $notification = 'You have successfully update your information.';
        } catch (\Exception $e) {
            DB::rollback();
            $notification = 'Something went wrong!';
            return redirect('user/edit/' . $id)->withErrors($notification);
        }
        return redirect('user/edit/' . $id)->with('notification', $notification);
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
        return redirect('home')->with('notification', $notification);
    }

    public function showContributeHistory() {
        $user = Sentinel::getUser();
        $id = $user->id;
        $dataKeyword = KeywordTemp::where('user_id', $user->id)->get();
        $dataMeaning = MeaningTemp::where('user_id', $user->id)->get();
        return view('user.contributeHistory', ['dataKeyword' => $dataKeyword, 'dataMeaning' => $dataMeaning]);
    }

    public function deleteKeywordContribute($id) {
        try {
            $keyword = KeywordTemp::find($id);

            DB::beginTransaction();
            $keyword->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('user/history');
    }

    public function deleteMeaningContribute($id) {
        try {
            $meaning = MeaningTemp::find($id);

            DB::beginTransaction();
            $meaning->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('user/history');
    }

}
