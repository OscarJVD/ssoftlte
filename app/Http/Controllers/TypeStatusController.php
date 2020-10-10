<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeStatus as TypeStatus;

class TypeStatusController extends Controller
{
    public function destroy($id){
        $type_status = TypeStatus::find($id);
        $type_status->delete();
        return redirect()->back();
    }

    public function show(Request $request){
        $type_statuses = TypeStatus::where('name','like','%'.$request->name.'%')->get();
        return \View::make('type_statuses/list',compact('type_statuses'));
    }

    public function edit($id)
    {
        $type_status = TypeStatus::find($id);
        return \View::make('type_statuses/update',compact('type_status'));
    }

    public function update($id,Request $request)
    {
        $type_status              = TypeStatus::find($id);
        $type_status->name        = $request->name;
        $type_status->save();
        return redirect(\Auth::user()->urlAll('status'));
    }

    public function index()
    {
        $type_statuses = TypeStatus::all();
        return \View::make('type_statuses/list',compact('type_statuses'));
    }

    public function create()
    {
        return \View::make('type_statuses/new');
    }

    public function store(Request $request)
    {
        $type_status = new TypeStatus;
        $type_status->create($request->all());
        return redirect(\Auth::user()->urlAll('status'));
    }
}
