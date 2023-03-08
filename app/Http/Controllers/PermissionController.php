<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function permissions(){
        return view('admin.Permissions.index');
    }

    /**
     * 
     * 
     * PERMISSION CREATE 
     * 
     */
    public function pathPermission(){
        $roles = Role::all();
        return view('admin.Permissions.permissionForm',compact('roles'));
    }

    // ** STORE PERMISSION 
    public function insertPermission(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole($request->role_name);
        return redirect()->route('permissions.index')->with('success','new user permission assigned');
    }
}