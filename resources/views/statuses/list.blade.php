@extends('layouts.app')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-center rounded border p-3 mb-1">
                <article class="col-md-6 text-center">
                    <h1 class="mb-0">
                        Listado de Estados
                    </h1>
                </article>
                <div class="col-md-6">
                    <article class="col-md-12 col-md-offset-1">
                        <form action="{{ url(Auth::user()->urlSearch('status') ) }}" method="post" novalidate class="form-inline">
                            @csrf
                            <div class="row justify-content-center text-center">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <input type="text" id="search" placeholder="Buscar" name="name" class="form-control mr-1 mb-1" required>
                                        <div class="">
                                            <button type="submit" class="btn btn-secondary">Buscar</button>
                                            <a href="{{ url(Auth::user()->urlAll('status') ) }}" class="btn btn-primary mr-1">Todo</a>
                                            <a href="{{ url(Auth::user()->urlCreate('status') ) }}" class="btn btn-success">Crear</a>
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
                    <table class="table text-center w-100 table-responsive-xs table-hover table-sm table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo de estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statuses as $status)
                            <tr>
                                <td>{{$status->name}}</td>
                                <td>{{$status->type_status->name}}</td>
                                <td>
                                    <a class="btn btn-outline-primary btn-sm my-2" href="{{ url(Auth::user()->urlEdit('status',$status->id) ) }}">Editar</a>
                                    <a class="btn btn-outline-danger btn-sm" href="{{ url(Auth::user()->urlDelete('status',$status->id)) }}">Eliminar</a>
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