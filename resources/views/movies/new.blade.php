@extends('layouts.app')
@section('content')
<section class="container">
    <movie url="{{ url(Auth::user()->urlAll('movie')) }}" :users="{{ $users }}" :categories="{{ $categories }}"></movie>
</section>
@endsection


