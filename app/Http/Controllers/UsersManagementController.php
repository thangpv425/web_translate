<?php

namespace App\Http\Controllers;

use App\User;
use Sentinel;
use Illuminate\Http\Request;

class UsersManagementController extends Controller
{
    public function index()
    {
    	$users = User::select('id', 'email', 'first_name', 'last_name', 'last_login')->get();
    	return view('admin.users-management', ['users' => $users]);
    }

    /**
     * Make an user to admin
     * @param  Request $request contain uses's id
     * @return boolean           true if success, otherwise return false
     */
    public function makeAdmin(Request $request)
    {
    	$user = Sentinel::findById($request->id);
    	if (empty($user)) {
            $notification = array(
                'message' => 'User not found!',
                'alert-type' => 'error',
            );
    	} elseif ($user->inRole('admin')) {
            $notification = array(
                'message' => 'This user has already been an Admin.',
                'alert-type' => 'error',
            );
    	} else {
			$role = Sentinel::findRoleByName('admin');
			$role->users()->attach($user);
            $notification = array(
                'message' => $user->email . ' is Admin now.',
                'alert-type' => 'success',
            );
    	}
		return redirect()->route('users-management')->with($notification);
    }

    public function cancelAdmin(Request $request)
    {
    	$user = Sentinel::findById($request->id);
    	if (empty($user)) {
            $notification = array(
                'message' => 'User not found!',
                'alert-type' => 'error',
            );
    	} elseif (!$user->inRole('admin')) {
            $notification = array(
                'message' => 'This user is not an Admin.',
                'alert-type' => 'error',
            );
    	} else {
			$role = Sentinel::findRoleByName('admin');
			$role->users()->detach($user);
            $notification = array(
                'message' => $user->email . ' is User now.',
                'alert-type' => 'success',
            );
    	}
		return redirect()->route('users-management')->with($notification);
    }
}
