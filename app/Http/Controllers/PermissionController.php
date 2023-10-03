<?php

namespace App\Http\Controllers;

use App\Models\PermissionName;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Permission_name = PermissionName::get();
        return view('admin.role_permission.permission',compact('Permission_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $Perm_name_id = PermissionName::create(['name'=>$request->name]); 
       Permission::create(['name'=>'create_'.$request->name,'perm_name_id'=>$Perm_name_id->id]); 
       Permission::create(['name'=>'update_'.$request->name,'perm_name_id'=>$Perm_name_id->id]); 
       Permission::create(['name'=>'read_'.$request->name,'perm_name_id'=>$Perm_name_id->id]); 
       Permission::create(['name'=>'delete_'.$request->name,'perm_name_id'=>$Perm_name_id->id]); 
       Permission::create(['name'=>$request->name,'perm_name_id'=>$Perm_name_id->id]); 

       if($Perm_name_id ){
            Alert::success('Success', 'Role has been created successfully');
            return redirect()->back();
        }else{
            Alert::success('Error', 'Something Went Wrong!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
