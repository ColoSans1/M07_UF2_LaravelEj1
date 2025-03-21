@extends('layout')

@section('title', 'Movies List')

@section('content')
<div class="container">
    <h1>CABECERA DE LA WEB MASTER</h1>
    <img src="https://imgs.search.brave.com/2wVwEpxJan47rTTjPWcnZGSSdRWns1gQuSdKJXeMoQ4/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/c2luY3JvZ3VpYS50/di9jb21tb24vcHJv/amVjdC9pbWcveHNl/by1tb3ZpZXMucG5n/LnBhZ2VzcGVlZC5p/Yy5IYjJ1blVLMGgt/LnBuZw" alt="Imagen principal" class="img-fluid">

    <h1 class="mt-4">Lista de Películas</h1>
    <ul>
        <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
        <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
        <li><a href="/filmout/films">Pelis</a></li>
        <li><a href="/countFilms">Contador de Películas</a></li>
        <li><a href="/sortFilms">Películas Ordenadas por Año</a></li>
        <li><a href="/films/create">Crear Película</a></li> 
        <li><a href="{{ route('actors.index') }}">Ver Actores</a></li>
    </ul>

    <h1>Lista de Actores</h1>
    <ul>
        <li><a href="/actors/byDecade">Listar Actores por Década</a></li>
        <li><a href="{{ route('actors.count') }}">Contador de Actores</a></li>
    </ul>

    <!-- Formulario para seleccionar la década -->
    <h2>Buscar Actores por Década de Nacimiento</h2>
    <form action="{{ route('actors.byDecade') }}" method="GET">
        <div class="form-group">
            <label for="decade">Selecciona una Década:</label>
            <select name="decade" id="decade" class="form-control">
                <option value="1980">1980 (1980-1989)</option>
                <option value="1990">1990 (1990-1999)</option>
                <option value="2000">2000 (2000-2009)</option>
                <option value="2010">2010 (2010-2019)</option>
                <option value="2020">2020 (2020-2029)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>
@endsection
