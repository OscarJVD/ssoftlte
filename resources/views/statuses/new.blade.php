@extends('layouts.app')
@section('content')
<section class="container">
    <div class="row justify-content-center mb-2">
        <article class="col-md-6 text-center p-3 bg-white rounded border">
            <h1 class="mb-0">
                Nuevo Estado
            </h1>
        </article>
    </div>
    <div class="row justify-content-center">
        <article class="col-md-6 col-md-offset-1 rounded border">
            <form action="{{ url(Auth::user()->urlAll('status') ) }}" method="post" class="p-3" novalidate>
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" placeholder="Nombre del estado" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tipo de estado</label>
                    <select name="type_status" class="form-control" required>
                        <option>Seleccione...</option>
                        @foreach($type_statuses as $type_status)
                        <option value="{{$type_status->id}}">{{$type_status->name}}</option>
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