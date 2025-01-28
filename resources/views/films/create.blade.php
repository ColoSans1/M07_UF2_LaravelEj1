@extends('layout')

@section('title', 'Añadir Película')

@section('content')
<div class="container mt-5">
    <h1>Añadir Nueva Película</h1>

    <!-- Mostrar mensaje de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar mensaje de error -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulario -->
    <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Token de seguridad obligatorio -->
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Título de la película" required>
        </div>

        <div class="form-group">
            <label for="year">Año</label>
            <input type="number" class="form-control" id="year" name="year" placeholder="Año de la película" required>
        </div>

        <div class="form-group">
            <label for="genre">Género</label>
            <input type="text" class="form-control" id="genre" name="genre" placeholder="Género de la película" required>
        </div>

        <div class="form-group">
            <label for="country">País</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="País de origen" required>
        </div>

        <div class="form-group">
            <label for="duration">Duración (minutos)</label>
            <input type="number" class="form-control" id="duration" name="duration" placeholder="Duración en minutos" required>
        </div>

        <div class="form-group">
            <label for="image">Imagen (opcional)</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Añadir Película</button>
    </form>
</div>
@endsection
