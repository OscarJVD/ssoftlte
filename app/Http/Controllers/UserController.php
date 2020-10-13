<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use App\Models\{Role, Status};
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Barryvdh\DomPDF\Facade as PDF;

class UserController extends Controller
{
    public function pdf()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
         **/
        $users = User::all();

        $pdf = PDF::loadView('pdf.users', compact('users'));

        return $pdf->download('listado.pdf');
    }

    public function import(Request $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new UsersImport, $file);
            return back()->with('message', "Importación exitosa :D");
        } catch (NoTypeDetectedException $e) {
            dd($e);
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function index()
    {
        $users = User::where('status_id', 1)->get();
        return \View::make('users/list', compact('users'));
    }

    public function show(Request $request)
    {
        $users = User::where('users.name', 'like', '%' . $request->name . '%')
            ->orWhere('users.email', 'like', '%' . $request->name . '%')
            ->join('roles', 'roles.id', '=', 'users.role_id')
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
        $roles = Role::where('status_id', 1)->get();
        $statuses = Status::where('type_status_id', 1)
            ->orWhere('type_status_id', 2)
            ->get();
        return \View::make('users/update', compact('user', 'roles', 'statuses'));
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

    public function updateStatus($id, Request $request) // delete user
    {
        $user              = User::find($id);

        if ($request->status == 1)
            $user->status_id   = 2;
        elseif ($request->status == 2)
            $user->status_id   = 1;

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
