<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use App\Models\{Role, Status};


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return \View::make('users/list', compact('users'));
    }

    public function show(Request $request)
    {
        $users = User::where('users.name', 'like', '%' . $request->name . '%')
                     ->orWhere('users.email', 'like', '%' . $request->name . '%')
                     ->join('roles','roles.id','=','users.role_id')
                     ->orWhere('roles.name', 'like', '%' . $request->name . '%')
                     ->select('users.*')
                     ->get();

        // $roles = Role::where('name', 'like', '%' . $request->name . '%');
        return \View::make('users/list', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('status_id', 1)->get();
        return \View::make('users/new', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name        = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role;
        $user->status_id = 1;
        $user->save();
        return redirect(\Auth::user()->urlAll('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where('status_id',1)->get();
        $statuses = Status::where('type_status_id',1)
                          ->orWhere('type_status_id',2)
                          ->get();
        return \View::make('users/update', compact('user','roles','statuses'));
    }

    public function update($id, Request $request)
    {
        $user              = User::find($id);
        $user->name        = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->status_id = $request->status;
        $user->role_id = $request->role;
        $user->save();
        return redirect(\Auth::user()->urlAll('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
