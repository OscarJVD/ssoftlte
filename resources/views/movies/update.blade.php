@extends('layouts.app')
@section('content')
<section class="container">
    <movieup url="{{ url( Auth::user()->urlUpdateP('movie','$movie->id') ) }}" :movie="{{ $movie }}" :users="{{ $users }}" :statuses="{{ $statuses }}" :categories="{{ $categories }}"></movieup>
</section>
@endsection