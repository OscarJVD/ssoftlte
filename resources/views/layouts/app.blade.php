<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name_2', 'senasoft') }}</title>

    <!-- Scripts -->
    <link href="{{ asset('./css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div id="app">
            <!--Instancia de Vue-->

            @if (isset(Auth::user()->role->name))

                <nav class="main-header navbar navbar-expand-md navbar-dark shadow-sm navColorText">

                @else
                    <nav class="navbar navbar-expand-md navbar-dark shadow-sm navColorText">

            @endif
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                @if (isset(Auth::user()->role->name))
                    <li class="nav-item mx-2 mr-4">
                        <a class="nav-link navColorText" data-widget="pushmenu" href="#" role="button">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                @endif

                <button class="navbar-toggler navColorText" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon navColorText"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name_2', 'senasoft') }}
                </a>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
                @else
                    <!-- Validación -->
                    @if (Auth::user()->role->name === 'Administrador')
                        @include('layouts.menus.admin')
                    @endif

                    @if (Auth::user()->role->name === 'Empleado')
                        @include('layouts.menus.employee')
                    @endif

                    @if (Auth::user()->role->name === 'Cliente')
                        @include('layouts.menus.client')
                    @endif


                @endguest
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @if (isset(Auth::user()->role->name))
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                                class="fa fa-sort-down"></i></a>
                    </li>
                @endif

            </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Authentication Links -->
            @guest
                <!-- Validación -->
                @if (Route::has('register'))
                @endif
            @else
                @if (Auth::user()->role->name === 'Administrador')
                    <!-- Main Sidebar Container -->
                    @include('layouts.menus.sidebaradmin')
                @endif

                @if (Auth::user()->role->name === 'Empleado')
                    @include('layouts.menus.employee')
                @endif

                @if (Auth::user()->role->name === 'Cliente')
                    @include('layouts.menus.client')
                @endif
            @endguest

            <main class="py-4">
                @yield('content')
            </main>

            @extends('layouts.footer')
