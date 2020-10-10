@extends('layouts.app')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-center rounded border p-3 mb-1">
                <article class="col-md-6 text-center">
                    <h1 class="mb-0">
                        Listado de Usuarios
                    </h1>
                </article>
                <div class="col-md-6">
                    <article class="col-md-12 col-md-offset-1">
                        <form action="{{url(Auth::user()->urlSearch('user'))}}" method="post" novalidate class="form-inline">
                            @csrf
                            <div class="row justify-content-center text-center">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <input type="text" id="search" placeholder="Buscar" name="name" class="form-control mr-1 mb-1" required>
                                        <div class="">
                                            <button type="submit" class="btn btn-secondary">Buscar</button>
                                            <a href="{{ url(Auth::user()->urlAll('user') ) }}" class="btn btn-primary mr-1">Todo</a>
                                            @if(Auth::user()->role->name != 'Cliente')
                                            <a href="{{ url(Auth::user()->urlCreate('user') ) }}" class="btn btn-success">Crear</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center rounded">
                <article class="col-md-12 p-0 m-0">
                    <table class="table text-center w-100 table-responsive-sm table-hover table-sm table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th>Rol</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->status->name}}</td>
                                <td>{{$user->role->name}}</td>
                                <td>
                                    @if(Auth::user()->role->name != 'Cliente')
                                    <a class="btn btn-outline-primary btn-sm my-2" href="{{ url( Auth::user()->urlEdit('user',$user->id) ) }}">Editar</a>
                                    <a class="btn btn-outline-danger btn-sm" href="{{ url(Auth::user()->urlDelete('user',$user->id)) }}">Eliminar</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection