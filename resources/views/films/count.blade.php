<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .counter {
            font-size: 1.5rem;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Bienvenido a nuestro sitio de películas</h1>
    <p class="counter">Actualmente tenemos un total de <strong>{{ $count }}</strong> películas disponibles.</p>
</body>
</html>
