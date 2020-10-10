<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name_2', 'Solupelis') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('./js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Favicon -->
    <!-- <link rel="Shortcut Icon" href="assets/img/1.ico{{ asset('js/app.js') }}"/> -->

    <!-- Styles -->
    <link href="{{ asset('./css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div id="app">
            <!--Instancia de Vue-->

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navColorText">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link navColorText" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <button class="navbar-toggler navColorText" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon navColorText"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name_2', 'Solupelis') }}
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

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                                class="fas fa-th-large"></i></a>
                    </li>
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

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        SenasoftVargas
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; Octubre 2020 <a href="#">AppName</a>.</strong> All rights reserved.
</footer>
