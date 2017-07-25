<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Sentinel;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',['roles' => $roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Sentinel::findRoleById($id);
        if(!empty($role)){
        	return view('admin.roles.edit',['role' => $role]);
        }else{
            return redirect()->action('RolesController@index')->with('errorsMessage', 'This ID not found in system');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateRoleRequest|Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(RoleRequest $request, $id)
    {
        
        return view('admin.roles.index',['roles' => $roles]);
    }
}
