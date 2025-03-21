@extends('layout')

@section('title', 'Total Actores')

@section('content')
<div class="container">
    <h1>Total de Actores</h1>

    @if(isset($actorCount))
        <p>Total de actores registrados: {{ $actorCount }}</p>
    @else
        <p>No se pudo obtener el conteo de actores.</p>
    @endif
</div>
@endsection
