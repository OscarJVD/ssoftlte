{{ libxml_use_internal_errors(true) }}
@extends('layouts.app')
@section('content')
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                        <li class="breadcrumb-item active">MyApp</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

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
                                            <form action="{{ url(Auth::user()->urlSearch('user')) }}" method="post" novalidate class="form-inline">
                                                @csrf
                                                <div class="row justify-content-center text-center">
                                                    <div class="col-md-12">
                                                        <div class="row justify-content-center">
                                                            <input type="text" id="search" placeholder="Buscar" name="name" class="form-control mr-1 mb-1" required>
                                                            <div class="">
                                                                <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                                                                <a href="{{ url(Auth::user()->urlAll('user')) }}" class="btn btn-primary"><i class="fa fa-reply-all"></i></a>
                                                                @if (Auth::user()->role->name != 'Cliente')
                                                                <a href="{{ url(Auth::user()->urlCreate('user')) }}" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                                                @endif
                                                                <a href="{{ route('users.pdf') }}" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i></a>
                                                                <a href="{{ url(Auth::user()->export('users')) }}" class="btn bg-gradient-green btn-sm text-light mr-1"><i class="fa fa-file-excel-o"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </article>
                                    </div>
                                    <div class="col-md-12 d-flex">
                                        <div class="flex-center d-flex position-ref full-height">
                                            <div class="container">

                                                <form action="{{ route('users.import.excel') }}" method="post" class="d-inline" enctype="multipart/form-data">
                                                    @csrf
                                                    @if (Session::has('message'))
                                                    <p>{{ Session::get('message') }}</p>
                                                    @endif
                                                    <div class="row">
                                                        <div class="file-field col-12">
                                                            <div class="btn btn-default btn-sm float-left d-inline">
                                                                <h4 class="d-block p-0 my-2">Importar Usuarios</h4>
                                                                <span>Seleccionar archivos</span>
                                                                <input type="file" name="file" class="d-inline" multiple>
                                                                <button type="submit" class="btn btn-success btn-sm mt-sm-2 text-center d-inline">Importar</button>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-3 d-inline">
                                                            <div class="custom-file">
                                                                <input type="file" name="file" class="custom-file-input">
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
                                                @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->status->name }}</td>
                                                    <td>{{ $user->role->name }}</td>
                                                    <td>
                                                        @if (Auth::user()->role->name != 'Cliente')
                                                        <a class="btn btn-warning btn-sm border-dark my-2 d-inline" href="{{ url(Auth::user()->urlEdit('user', $user->id)) }}"><i class="fa fa-edit"></i></a>
                                                        <form class="d-inline" action="{{ url(Auth::user()->urlUpdateStatus('user', $user->id)) }}" method="post" novalidate>
                                                            @csrf
                                                            <input type="hidden" name="status" class="d-none" value="{{ $user->status_id }}">
                                                            <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                                                                <i class="fa fa-trash d-inline"></i>
                                                            </button>
                                                        </form>
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection