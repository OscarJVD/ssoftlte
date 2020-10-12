@extends('layouts.app')
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Starter Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
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
                                                Listado de Roles
                                            </h1>
                                        </article>
                                        <div class="col-md-6">
                                            <article class="col-md-12 col-md-offset-1">
                                                <form action="{{ url(Auth::user()->urlSearch('role')) }}" method="post"
                                                    novalidate class="form-inline">
                                                    @csrf
                                                    <div class="row justify-content-center text-center">
                                                        <div class="col-md-12">
                                                            <div class="row justify-content-center">
                                                                <input type="text" id="search" placeholder="Buscar"
                                                                    name="name" class="form-control mr-1 mb-1" required>
                                                                <div class="">
                                                                    <button type="submit"
                                                                        class="btn btn-secondary">Buscar</button>
                                                                    <a href="{{ url(Auth::user()->urlAll('role')) }}"
                                                                        class="btn btn-primary mr-1">Todo</a>
                                                                    <a href="{{ url(Auth::user()->urlCreate('role')) }}"
                                                                        class="btn btn-success">Crear</a>
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
                                            <table
                                                class="table text-center table-responsive-xs table-hover table-sm table-striped table-bordered mt-2">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Estado</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($roles as $role)
                                                        <tr>
                                                            <td>{{ $role->name }}</td>
                                                            <td>{{ $role->status->name }}</td>
                                                            <td>
                                                                <a class="btn btn-outline-primary btn-sm my-2"
                                                                    href="{{ url(Auth::user()->urlEdit('role', $role->id)) }}">Editar</a>
                                                                <a class="btn btn-outline-danger btn-sm"
                                                                    href="{{ url(Auth::user()->urlDelete('role', $role->id)) }}">Eliminar</a>
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
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @endsection
