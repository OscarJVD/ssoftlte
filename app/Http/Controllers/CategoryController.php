<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category,Status};

class CategoryController extends Controller
{
    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->back();
    }

    public function show(Request $request){
        $categories = Category::where('name','like','%'.$request->name.'%')->get();
        return \View::make('categories/list',compact('categories'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $statuses = Status::where('type_status_id',1)->get();
        return \View::make('categories/update',compact('category','statuses'));
    }

    public function update($id,Request $request)
    {
        $category              = Category::find($id);
        $category->name        = $request->name;
        $category->status_id = $request->status;
        $category->save();
        return redirect(\Auth::user()->urlAll('category'));
    }

    public function index()
    {
        $categories = Category::all();
        return \View::make('categories/list',compact('categories'));
    }

    public function create()
    {
        return \View::make('categories/new');
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->status_id = 1;
        $category->save();
        return redirect(\Auth::user()->urlAll('category'));
    }
}
