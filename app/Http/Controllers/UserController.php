<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meaning;
use App\Keyword;
use App\KeywordTemp;
use App\MeaningTemp;
use Illuminate\Support\Facades\DB;use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Validator;
use App\Repositories\Interfaces\UserRepositoryInterface;

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

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'first_name' => 'required|min:1|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                    'last_name' => 'required|min:1|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
                        ], [
                    'first_name.required' => 'Please enter first name',
                    'last_name.required' => 'Please enter last name',
                    'first_name.min' => 'The length of first name is bigger than 1',
                    'last_name.min' => 'The length of last name is bigger than 1',
                    'first_name.regex' => 'Only accept lowercase or uppercase letters',
                    'last_name.regex' => 'Only accept lowercase or uppercase letters'
        ]);

        if ($validator->fails()) {
            return redirect('user/edit/' . $id)
                            ->withErrors($validator)
                            ->withInput();
        }

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->update();
        return redirect('user/edit/' . $id)->with('notification', 'Edit completed');
    }

    public function addKeyword() {
        return view('user.keywordAdd');
    }

    public function processAddKeyword(Request $request) {
        try {
            $user = Sentinel::getUser();
            $dataMeaning = array();

            DB::beginTransaction();
            $keyword = Keyword::create([
                        'keyword' => $request->keyword,
                        'status' => IN_QUEUE
            ]);
            $keyword_temp = KeywordTemp::create([
                        'opCode' => ADD,
                        'user_id' => $user->id,
                        'old_keyword_id' => $keyword->id,
                        'new_keyword' => $request->keyword,
                        'comment' => $request->comment
            ]);
            foreach ($request->translate as $key => $value) {
                $dataMeaning[] = array(
                    'opCode' => ADD,
                    'user_id' => $user->id,
                    'keyword_id' => $keyword->id,
                    'new_meaning' => $value['meaning'],
                    'index' => $key,
                    'language' => $value['language'],
                    'comment' => $request->comment,
                    'type' => $request->type
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
            return redirect('user/add/keyword')->withErrors($notification);
        }
        return redirect('home')->with('notification', $notification);
    }

}
