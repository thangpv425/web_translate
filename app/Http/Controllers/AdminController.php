<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\KeywordTemp;
use App\MeaningTemp;
use App\Users;
use App\keyword;
use App\meaning;
use Validator;
class AdminController extends Controller
{
	/**
	 * return List request of keyword table
	 * @return [type] [description]
	 */
    public function keywordTempList()
    {
    	$data = KeywordTemp::all();
    	return view('admin.approve.keyword.all', ['data' => $data]);
    }
    /**
     * Approve request on keyword table
     * @param  [type] $id     [description]
     * @param  [type] $opCode [description]
     * @return [type]         [description]
     */
    public function keywordApprove(Request $request)
    {
    	// echo $id;
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = KeywordTemp::find($id);
    	if($data != null){
    		switch ($opCode) {
	    		case '0': // Add
	    			$keyword = keyword::find($data->old_keyword_id);
	    			$keyword->status = 1;
                    $keyword->save();
                    $data->delete();
	    			break;
	    		case '1': // Edit
	    			$keyword = keyword::find($data['old_keyword_id']);
	    			$keyword->value = $data['new_keyword'];
                    $keyword->save();
                    $data->delete();
	    			break;
	    		case '2': // Delete
	    			$keyword = keyword::find($data['old_keyword_id']);
	    			$keyword->status = 0;
                    $keyword->save();
                    $data->delete();
	    			break;	
	    		default:
	    			break;
    		}
    		
    	}
    	return redirect()->route('keywordTempList');
    }
    /**
     * Decline request on keyword table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function keywordDecline(Request $request)
    {
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = KeywordTemp::find($id);
    	if($data != null){
    		switch ($opCode) {
	    		case '0': // Decline Add
	    			// Delete row on wt_keyword table
	    			// Delete meaning on wt_meaning_temp table
	    			$keyword = keyword::find($data['old_keyword_id']);
	    			$data->delete();
	    			$keyword->delete();
	    			break;
	    		case '1': // Decline Edit
	    		case '2': // Decline Delete
	    			$data->delete();
	    			break;	
	    		default:
	    			break;
    		}	
    	}
    	return redirect()->route('keywordTempList');
    }
    /**
     * return list request on meaning table
     * @return [type] [description]
     */
    public function meaningTempList()
    {
    	$data = MeaningTemp::all();
    	return view('admin.approve.meaning.list', ['data' => $data]);
    }
    public function meaningApprove(Request $request)
    {
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = MeaningTemp::find($id);
    	if ($data != null) {
        	switch ($opCode) {
	    		case '0':
	    			$meaning = new meaning;
	    			$meaning->value = $data['new_meaning'];
	    			$meaning->language = $data['language'];
	    			$meaning->index = $data['index'];
                    $meaning->keyword_id = $data['keyword_id'];
                    $meaning->status = 1;
	    			$meaning->save();
	    			$data->delete();
	    			break;
	    		case '1': // Edit
	    			$meaning = meaning::find($data['old_meaning_id']);
	    			$meaning->value = $data['new_meaning'];
	    			break;
	    		case '2': // Delete
	    			$meaning = meaning::find($data['old_meaning_id']);
	    			$meaning->status = 0;
	    			break;
	    		default:
	    			
	    			break;
    		}
    		$meaning->save();
	    	$data->delete();
    	}
    	return redirect()->route('meaningTempList');
    }
    public function meaningDecline(Request $request)
    {
    	$data = MeaningTemp::find($request->id);
    	if($data != null){
    		$data->delete();
    	}
    	return redirect()->route('meaningTempList');
    }
    
     public function show()
    {
        $users = Users::all();
        return view('users.show', ['users' => $users]);
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name'=>'required|min:3',
                'last_name'=>'required|min:3',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'password_confirm' => 'required|min:6|max:32|same:password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            [
                'first_name.required'=>'Please enter name.',
                'last_name.required'=>'Please enter name.',
                'first_name.min'=>'Name length is greater than 3.',
                'last_name.min'=>'Name length is greater than 3.',
                'email.required'=>'Please input email.',
                'email.email'=>'Enter the correct Email format.',
                'email.unique'=>'Email is identical.',
                'password.required'=>'Please input password',
                'password.min'=>'Password length is greater than 6 and less than 32.',
                'password.max'=>'Password length is greater than 6 and less than 32.',
                'password.regex'=>'Contain at least one uppercase/lowercase letters and one number.',
                'password_confirm.required'=>'Please input password.',
                'password_confirm.min'=>'Password length is greater than 6 and less than 32.',
                'password_confirm.max'=>'Password length is greater than 6 and less than 32.',
                'password_confirm.same'=>'The password don\'t match. Try again?',
                'password_confirm.regex'=>'Contain at least one uppercase/lowercase letters and one number.'
            ]);
        if ($validator->fails()) {
            return redirect('admin/create')
                ->withErrors($validator)
                ->withInput();
        }
        $user = new Users;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        //send mail
//        $data = ['email'=>$request->email,'password'=>$request->password,'name'=>$request->name];
//        Mail::send(['text'=>'mail'],['data'=> $data],function($message) use ($data){
//            $message->to($data['email'],$data['name'])->subject('Create account');
//            $message->from('manhnvit@gmail.com','Admin');
//        });
        $user->save();
        return redirect('admin/show')->with('notification','You have successfully added the user');
    }
    public function delete($id = NULL)
    {
        $user = Users::find($id);
        $user->delete();
        return redirect('admin/show')->with('notification','You have successfully deleted the user');
    }
}