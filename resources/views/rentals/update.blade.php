@extends('layouts.app')
@section('content')
<section class="container">
    <div class="row justify-content-center mb-2">
        <article class="col-md-6 text-center p-3 bg-white rounded border">
            <h1 class="mb-0">
                Editar Alquiler
            </h1>
        </article>
    </div>
    <div class="row justify-content-center">
        <article class="col-md-6 col-md-offset-1 rounded border">
            <form action="{{ url( Auth::user()->urlUpdate('rental',$rental->id) ) }}" class="p-3" method="post" novalidate>
                @csrf
                <div class="form-group">
                    <label>Fecha inicial</label>
                    <input type="date" name="start_date" class="form-control" required value="{{ App\Tools\Utility::parseDate($rental->start_date) }}">
                </div>
                <div class="form-group">
                    <label>Fecha final</label>
                    <input type="date" name="end_date" class="form-control" required value="{{ App\Tools\Utility::parseDate($rental->end_date) }}">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" name="total" class="form-control" required value="{{$rental->total}}">
                </div>
                <div class="form-group">
                    <label>Usuario</label>
                    <select name="user" class="form-control">
                        @foreach($users as $user)
                        @if($user->id == $rental->user_id)
                        <option selected value="{{$user->id}}">{{$user->name}}</option>
                        @else
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="status" class="form-control">
                        @foreach($statuses as $status)
                        @if($status->id == $rental->status_id)
                        <option selected value="{{$status->id}}">{{$status->name}}</option>
                        @else
                        <option value="{{$status->id}}">{{$status->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success shadow-sm">Enviar</button>
                </div>
            </form>
        </article>
    </div>
</section>
@endsection