@extends('layouts.app')
@section('content')
<section class="container">
    <div class="row justify-content-center mb-2">
        <article class="col-md-6 text-center p-3 bg-white rounded border">
            <h1 class="mb-0">
                Nuevo Usuario
            </h1>
        </article>
    </div>
    <div class="row justify-content-center">
        <article class="col-md-6 col-md-offset-1 rounded border">
            <form action="{{ url(Auth::user()->urlAll('user') ) }}" method="post" class="p-3" novalidate>
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" placeholder="Nombre del usuario" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="email" placeholder="Correo del usuario" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Clave</label>
                    <input type="password" name="password" placeholder="Contraseña del usuario" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select name="role" class="form-control" id="rol" required>
                        <option>Seleccione...</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
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