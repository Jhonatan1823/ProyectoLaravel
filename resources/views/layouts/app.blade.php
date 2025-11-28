<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Celuaccel')</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS Global -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- CSS específico por página -->
    @stack('styles')
</head>
<body>
    <!-- Header global (opcional) -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Celuaccel</a>
            </div>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer global (opcional) -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container text-center">
            <p>&copy; 2024 Celuaccel. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
