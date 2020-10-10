@extends('layouts.app')
@section('content')
<section class="container">
    <div class="row justify-content-center mb-2">
        <article class="col-md-6 text-center p-3 bg-white rounded border">
            <h1 class="mb-0">
                Editar Usuario
            </h1>
        </article>
    </div>
    <div class="row justify-content-center">
        <article class="col-md-6 col-md-offset-1 rounded border">
            <form action="{{ url( Auth::user()->urlUpdate('user',$user->id) ) }}" class="p-3" method="post" novalidate>
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" required value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="email" class="form-control" required value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label>Clave</label>
                    <input type="password" name="password" class="form-control" required value="{{$user->password}}">
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="status" class="form-control" id="rol" required>
                        <option>Seleccione...</option>
                        @foreach($statuses as $status)
                        @if($status->id == $user->status_id)
                        <option value="{{$status->id}}" selected>{{$status->name}}</option>
                        @else
                        <option value="{{$status->id}}">{{$status->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select name="role" class="form-control" id="rol" required>
                        <option>Seleccione...</option>
                        @foreach($roles as $role)
                        @if($role->id == $user->role_id)
                        <option value="{{$role->id}}" selected>{{$role->name}}</option>
                        @else
                        <option value="{{$role->id}}">{{$role->name}}</option>
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