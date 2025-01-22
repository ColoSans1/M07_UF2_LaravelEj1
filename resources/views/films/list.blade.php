<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container">

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
                            <td>{{ $film['name'] }}</td>
                            <td>{{ $film['year'] }}</td>
                            <td>{{ $film['genre'] }}</td>
                            <td><img src="{{ $film['img_url'] }}" style="width: 100px; height: 120px;" /></td>
                            <td>{{ $film['country'] }}</td>
                            <td>{{ $film['duration'] }} min</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</body>
</html>
