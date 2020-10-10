@extends('layouts.app')
@section('content')
<section class="container">
    <div class="row justify-content-center mb-2">
        <article class="col-md-6 text-center p-3 bg-white rounded border">
            <h1 class="mb-0">
                Editar Categoría
            </h1>
        </article>
    </div>
    <div class="row justify-content-center">
        <article class="col-md-6 col-md-offset-1 rounded border">
            <form action="{{ url( Auth::user()->urlUpdate('category',$category->id) ) }}" class="p-3" method="post" novalidate>
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" required value="{{$category->name}}">
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="status" class="form-control" required>
                        @foreach($statuses as $status)
                        @if($status->id == $category->status_id)
                        <option selected value="{{$status->id}}">{{$status->name}}</option>
                        @else
                        <option value="{{$status->id}}">{{$status->name}}</option>
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