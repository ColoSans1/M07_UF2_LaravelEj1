<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
        }

        header {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
        }

        footer {
            background-color: #343a40;
            color: white;
        }

        h1 {
            font-weight: 700;
        }

        .nav-link {
            font-weight: 600;
        }

        .footer-text {
            font-size: 0.9rem;
        }

        .main-content {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #6a11cb;
            border-color: #6a11cb;
        }

        .btn-primary:hover {
            background-color: #2575fc;
            border-color: #2575fc;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="py-5">
        <div class="container text-center">
            <h1 class="display-4">Mi Aplicación</h1>
            <p class="lead">Una experiencia de usuario moderna y profesional</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container my-5">
        <div class="main-content">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-3 mt-5">
        <div class="container text-center">
            <p class="footer-text">&copy; {{ date('Y') }} Mi Aplicación. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
