<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role; //inside vendor folder
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get()->all();
        return view('admin.role_permission.role',compact('roles'));
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
        $request->validate([
            'name'=>'required',
        ]);
        $role = Role::create([
            'name'=>$request->name,
        ]);
        $res = $role->save();
        if($res){
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
        // dd($id);
        $single_data    =   Role::find($id);
        return view('admin.role_permission.role',compact('single_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'     =>'required',
        ]);
        $res    =   Role::find($id)->update([
            'name' =>$request->name ?? '',
        ]);
        if($res){
            Alert::alert('Great', 'Role has updated successfully');
            return redirect()->route('role.index');
        }else{
            Alert::alert('Error', 'Something went wrong!');
            return redirect()->route('role.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Role::find($id);
        if($data->delete()){
            Alert::alert('Great', 'Role has Deleted successfully');
            return redirect()->back();  
       }else{
            Alert::alert('Error', 'Role has not Deleted');
            return redirect()->back();
       }
    }
}
