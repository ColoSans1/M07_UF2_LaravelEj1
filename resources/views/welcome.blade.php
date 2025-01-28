@extends('layout')

@section('title', 'Movies List')

@section('content')
<div class="container">
    <h1>CABECERA DE LA WEB MASTER</h1>
    <img src="https://imgs.search.brave.com/2wVwEpxJan47rTTjPWcnZGSSdRWns1gQuSdKJXeMoQ4/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/c2luY3JvZ3VpYS50/di9jb21tb24vcHJv/amVjdC9pbWcveHNl/by1tb3ZpZXMucG5n/LnBhZ2VzcGVlZC5p/Yy5IYjJ1blVLMGgt/LnBuZw">

    <h1 class="mt-4">Lista de Películas</h1>
    <ul>
        <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
        <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
        <li><a href="/filmout/films">Pelis</a></li>
        <li><a href="/countFilms">Contador de Películas</a></li>
        <li><a href="/sortFilms">Películas Ordenadas por Año</a></li>
        <li><a href="/films/create">Crear Película</a></li> 
    </ul>
</div>
@endsection
