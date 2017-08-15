<?php

namespace App\Http\Controllers;

use App\User;
use App\Meaning;
use App\MeaningTemp;
use App\Http\Requests\ImproveMeaningRequest;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Validator;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // protected $user;

    // public function __construct(UserRepositoryInterface $user)
    // {
    //     $this->user = $user;
    // }

    public function view($id = NULL)
    {
        $user = User::find($id);
        return view('user.view')->with('user', $user);
    }

    public function edit($id = NULL)
    {
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required|min:1|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'last_name' => 'required|min:1|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
            ],
            [
                'first_name.required'=>'Please enter first name',
                'last_name.required'=>'Please enter last name',
                'first_name.min'=>'The length of first name is bigger than 1',
                'last_name.min'=>'The length of last name is bigger than 1',
                'first_name.regex'=>'Only accept lowercase or uppercase letters',
                'last_name.regex'=>'Only accept lowercase or uppercase letters'
            ]);

        if ($validator->fails()) {
            return redirect('user/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user ->update();
        return redirect('user/edit/'.$id)->with('notification','Edit completed');
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