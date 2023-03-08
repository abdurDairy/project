<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function roles(){
        $roles = Role::all();
        return view('admin.Roles.index',compact('roles'));
    }

    /**
     * 
     * role create PATH
     * 
     */
    public function pathRoles(){
        return view('admin.Roles.roleForm');
    }

    /**
     * INSERT ROLE 
     * 
     */
    public function insertRoles(Request $request){
        $request->validate([
            'role_name' => 'required|unique:roles,name',
        ]);
        $db_role = new Role();
        $db_role->name = $request->role_name; 
        $db_role->save();
        return redirect()->route('roles.index')->with('success', 'new role assigned !');
    }
}