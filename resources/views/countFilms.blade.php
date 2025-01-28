@extends('layout')

@section('title', 'Total Films')

@section('content')
<div class="container">
    <h1>Total Films</h1>
    <p>The total number of films is: <strong>{{ $filmCount }}</strong></p>
</div>
@endsection
