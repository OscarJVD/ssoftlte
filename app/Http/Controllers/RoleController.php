<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Role,Status};

class RoleController extends Controller
{
    public function destroy($id){
        $role = Role::find($id);
        $role->delete();
        return redirect()->back();
    }

    public function show(Request $request){
        $roles = Role::where('name','like','%'.$request->name.'%')->get();
        return \View::make('roles/list',compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $statuses = Status::where('type_status_id',1)->get();
        return \View::make('roles/update',compact('role','statuses'));
    }

    public function update($id,Request $request)
    {
        $role              = Role::find($id);
        $role->name        = $request->name;
        $role->status_id = $request->status;
        $role->save();
        return redirect(\Auth::user()->urlAll('role'));
    }

    public function index()
    {
        $roles = Role::all();
        return \View::make('roles/list',compact('roles'));
    }

    public function create()
    {
        return \View::make('roles/new');
    }

    public function store(Request $request)
    {
        $role = new Role;
        $role->name        = $request->name;
        $role->status_id = 1;
        $role->save();
        return redirect(\Auth::user()->urlAll('role'));
    }
}
