@extends('layout')

@section('title', $title)

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    @if(empty($films))
        <span style="color: red;">No se ha encontrado ninguna película</span>
    @else
        <div align="center">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Año</th>
                        <th>Género</th>
                        <th>Imagen</th>
                        <th>País</th>
                        <th>Duración</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($films as $film)
                        <tr>
                            <td>{{ $film['name'] ?? $film['title'] ?? 'Sin nombre' }}</td>
                            <td>{{ $film['year'] }}</td>
                            <td>{{ $film['genre'] }}</td>
                            <td>
                                @if(isset($film['img_url']))
                                    <img src="{{ $film['img_url'] }}" style="width: 100px; height: 120px;" />
                                @else
                                    <span>Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $film['country'] }}</td>
                            <td>{{ $film['duration'] }} min</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

