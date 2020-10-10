<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Status, TypeStatus};

class StatusController extends Controller
{
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();
        return redirect()->back();
    }

    public function show(Request $request)
    {
        $statuses = Status::where('name', 'like', '%' . $request->name . '%')->get();
        return \View::make('statuses/list', compact('statuses'));
    }

    public function edit($id)
    {
        $status = Status::find($id);
        $type_statuses = TypeStatus::all();
        return \View::make('statuses/update', compact('status','type_statuses'));
    }

    public function update($id, Request $request)
    {
        $status              = Status::find($id);
        $status->name        = $request->name;
        $status->type_status_id = $request->type_status_id;
        $status->save();
        return redirect(\Auth::user()->urlAll('status'));
    }

    public function index()
    {
        $statuses = Status::all();
        return \View::make('statuses/list', compact('statuses'));
    }

    public function create()
    {
        $type_statuses = TypeStatus::all();
        return \View::make('statuses/new', compact('type_statuses'));
    }

    public function store(Request $request)
    {
        $status = new Status;
        $status->name = $request->name;
        $status->type_status_id = $request->type_status;
        $status->save();
        return redirect(\Auth::user()->urlAll('status'));
    }
}
