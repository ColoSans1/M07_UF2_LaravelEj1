@extends('layout')

@section('title', 'Lista de Actores')

@section('content')
<div class="container">
    <h1>Lista de Actores</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>País</th>
                <th>Imagen</th>
                <th>Acciones</th> 
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
                    <td>
                        <!-- Formulario para eliminar un actor -->
                        <form action="{{ route('actors.destroy', $actor->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a este actor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
