@extends('layout')

@section('title', 'Lista de Actores')

@section('content')
<div class="container">
    <h1>Lista de Actores</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>País</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actors as $actor)
                <tr>
                    <td>{{ $actor->name }}</td>
                    <td>{{ $actor->surname }}</td>
                    <td>{{ $actor->birthdate }}</td>
                    <td>{{ $actor->country }}</td>
                    <td>
                        <img src="{{ $actor->img_url }}" alt="{{ $actor->name }}" width="100">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
