@extends('layouts.app')
@section('content')
<section class="container">
    <rental url="{{ url(Auth::user()->urlAll('rental') ) }}" :users="{{ $users }}" :movies="{{ $movies }}"></rental>
</section>
@endsection