<?php

namespace App\Http\Controllers;

use App\Models\PermissionName;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    function index()
    {
        $roles = Role::get();
        return view('admin.role_permission.role_has_permission', compact('roles'));
    }
    function create(Request $request)
    {
        $selectrole =Role::find($request->role_id);
        $roles = Role::get();
        $permission_name = PermissionName::get();
        return view('admin.role_permission.role_has_permission', compact('roles', 'permission_name','selectrole'));
    }
    function store(Request $request)
    {
        $dt = Role::find($request->roleid)->syncPermissions($request->permission_id);
        return back();
    }

}
