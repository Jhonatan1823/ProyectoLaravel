<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente - Celuaccel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#">Celuaccel - Cliente</a>
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-outline-light">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>¡Bienvenido, {{ Auth::user()->Nombre }}!</h1>
        <p>Has iniciado sesión como <strong>Cliente</strong></p>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Información del Usuario</h5>
                <p><strong>ID:</strong> {{ Auth::user()->ID_Usuario }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->Correo }}</p>
                <p><strong>Teléfono:</strong> {{ Auth::user()->Telefono }}</p>
            </div>
        </div>
    </div>
</body>
</html>
