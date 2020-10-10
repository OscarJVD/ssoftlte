@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('') }}</div> -->
                <div class="card-body bg-info text-center font-lg text-light rounded">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bienvenid@ a Solupelis') }}
                    <p>Donde podras administrar toda tu información de películas de forma segura</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
