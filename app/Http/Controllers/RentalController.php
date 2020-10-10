<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Rental, Status, Movie};
use App\User;

class RentalController extends Controller
{
    public function destroy($id)
    {
        $rental = Rental::find($id);
        $rental->delete();
        return redirect()->back();
    }

    public function show(Request $request)
    {
        $rentals = Rental::where('start_date', 'like', '%' . $request->name . '%')
            ->orWhere('end_date', 'like', '%' . $request->name . '%')
            ->orWhere('total', 'like', '%' . $request->name . '%')
            ->get();
        return \View::make('rentals/list', compact('rentals'));
    }

    public function edit($id)
    {
        $rental = Rental::find($id);
        if (\Auth::user()->role->name === 'Cliente') {
            if ($rental->user_id == \Auth::user()->id) {
                $users = User::where('status_id', 1)->get();
                $statuses = Status::where('type_status_id', 1)->get();
                return \View::make('rentals/update', compact('rental', 'users', 'statuses'));
            } else {
                return redirect(\Auth::user()->urlAll('rental'));
            }
        } elseif (\Auth::user()->role->name === 'Administrador' || \Auth::user()->role->name === 'Empleado') {
            $users = User::where('status_id', 1)->get();
            $statuses = Status::where('type_status_id', 1)->get(); // El estado no tiene estado
            return \View::make('rentals/update', compact('rental', 'users', 'statuses'));
        } else {
            return redirect(\Auth::user()->urlAll('rental'));
        }
    }

    public function update($id, Request $request)
    {
        $rental              = Rental::find($id);
        $rental->start_date  = $request->start_date;
        $rental->end_date    = $request->end_date;
        $rental->total       = $request->total;
        $rental->user_id     = $request->user;
        $rental->status_id   = $request->status;
        $rental->save();
        return redirect(\Auth::user()->urlAll('rental'));
    }

    public function index()
    {
        if (\Auth::user()->role->name === 'Cliente') {
            $rentals = Rental::where('user_id', \Auth::user()->id)->get(); // trae las rentas del usuario en sesión
        } elseif (\Auth::user()->role->name === 'Administrador' || \Auth::user()->role->name === 'Empleado') {
            $rentals = Rental::all();
        }
        return \View::make('rentals/list', compact('rentals'));
    }

    public function create()
    {
        $users = User::where('status_id', 1)->get();
        $movies = Movie::where('status_id', 1)->get();
        return \View::make('rentals/new', compact('users', 'movies'));
    }

    public function store(Request $request)
    {
        $rental         = $this->saveRental($request);
        $movieRental    = $this->saveMovieRental($rental, $request->arrMovies, $request->price, $request->observations);

        if (!isset($rental['error']) && !isset($movieRental['error'])) {
            $resp = [
                'success' => true,
                'message' => 'Inserción correcta'
            ];
            return response()->json($resp);
        } else {
            $resp = [
                'error' => true,
                'message' => 'Error creando el alquiler (' . $rental['message'] . ', ' . $movieRental['error'] . ')'
            ];
            return response()->json($resp);
        }
    }

    public function saveRental($request)
    {
        try {
            $rental = new Rental;
            $rental->start_date     = $request->start_date;
            $rental->end_date       = $request->end_date;
            $rental->total          = $request->total;
            $rental->user_id        = $request->user['id'];
            $rental->status_id      = 1;
            $rental->save();

            return $rental;
        } catch (\Exception $e) {
            $resp = [
                'error'     => true,
                'message'   => 'Error insertando el alquiler (' . $e->getMessage() . ')'
            ];
            return $resp;
        }
    }

    public function saveMovieRental($rental, $arrMovies, $price, $observations)
    {
        try {
            $rental->movies()->detach();

            foreach ($arrMovies as $movie) {
                $rental->movies()->attach($movie['id'], ['price' => $price, 'observations' => $observations]);
            }

            return $rental;
        } catch (\Exception $e) {
            $resp = [
                'error'     => true,
                'message'   => 'Error insertando el detalle del alquiler (' . $e->getMessage() . ')'
            ];
            return $resp;
        }
    }
}
