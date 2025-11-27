<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celuaccel - Público</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#">Celuaccel</a>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1>Bienvenido a Celuaccel</h1>
        <p>Página pública de nuestro sistema de reparación de celulares.</p>
        <a href="{{ route('login') }}" class="btn btn-danger">Iniciar Sesión</a>
    </div>
</body>
</html>
