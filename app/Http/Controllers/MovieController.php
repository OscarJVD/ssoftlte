<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Movie, Status, Category};
use App\User as User;

class MovieController extends Controller
{
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return redirect()->back();
    }

    public function show(Request $request)
    {
        $movies = Movie::where('name', 'like', '%' . $request->name . '%')->get();
        return \View::make('movies/list', compact('movies'));
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        $users = User::where('status_id', 1)->get();
        $statuses = Status::where('type_status_id', 1)->orWhere('type_status_id', 3)->get();  // El estado no tiene estado
        $categories = Category::where('status_id', 1)->get();
        return \View::make('movies/update', compact('movie', 'users', 'statuses', 'categories'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $movie          = $this->editMovie($request);
        $categoryMovie  = $this->saveCategoryMovie($movie, $request->arrCategories);

        if (!isset($movie['error']) && !isset($categoryMovie['error'])) {
            $resp = [
                'success' => true,
                'message' => 'Inserción correcta'
            ];
            return response()->json($resp);
        } else {
            $resp = [
                'error' => true,
                'message' => 'Error creando la película (' . $movie['message'] . ', ' . $categoryMovie['error'] . ')'
            ];
            return response()->json($resp);
        }
    }

    public function editMovie($request)
    {
        try {

            $movie              = Movie::find($request->id);
            $movie->name        = $request->name;
            $movie->description = $request->description;
            $movie->user_id     = $request->user;
            $movie->status_id   = $request->status;
            $movie->save();

            return $movie;
        } catch (\Exception $e) {
            $resp = [
                'error'     => true,
                'message'   => 'Error editando la película (' . $e->getMessage() . ')'
            ];
            return ($resp);
        }
    }

    public function index()
    {
        $movies = Movie::all();
        return \View::make('movies/list', compact('movies'));
    }

    public function create()
    {
        $users = User::where('status_id', 1)->get();
        $categories = Category::where('status_id', 1)->get();
        return \View::make('movies/new', compact('users', 'categories'));
    }

    public function store(Request $request)
    {
        $movie          = $this->saveMovie($request);
        $categoryMovie  = $this->saveCategoryMovie($movie, $request->arrCategories);

        if (!isset($movie['error']) && !isset($categoryMovie['error'])) {
            $resp = [
                'success' => true,
                'message' => 'Inserción correcta'
            ];
            return response()->json($resp);
        } else {
            $resp = [
                'error' => true,
                'message' => 'Error creando la película (' . $movie['message'] . ', ' . $categoryMovie['error'] . ')'
            ];
            return response()->json($resp);
        }
    }

    public function saveMovie($request)
    {
        try {

            $movie = new Movie;
            $movie->name            = $request->name;
            $movie->description     = $request->description;
            $movie->user_id         = $request->user['id'];
            $movie->status_id       = 1;
            $movie->save();

            return $movie;
        } catch (\Exception $e) {
            $resp = [
                'error'     => true,
                'message'   => 'Error insertando la película (' . $e->getMessage() . ')'
            ];
            return ($resp);
        }
    }

    public function saveCategoryMovie($movie, $arrCategories)
    {
        try {
            $movie->categories()->detach();

            foreach ($arrCategories as $category) {

                $movie->categories()->attach($category['id']);
            }

            return true;
        } catch (\Exception $e) {
            $resp = [
                'error'     => true,
                'message'   => 'Error insertando el detalle de la película (' . $e->getMessage() . ')'
            ];
            return ($resp);
        }
    }
}
