<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente - Celuaccel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: white;
        }
        
        .header {
            background: #d20000;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .btn-logout {
            background: #1c1c1c;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .welcome-section {
            background: #f5f5f5;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .module-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .module-card:hover {
            transform: translateY(-5px);
        }
        
        .module-card h3 {
            color: #d20000;
            margin-bottom: 1rem;
        }
        
        .btn-module {
            background: #d20000;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Celuaccel - Cliente</h1>
        <div class="user-info">
            <span>Hola, {{ Auth::user()->Nombre }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div style="background:#e6ffe6; color:#008000; padding:1rem; border-radius:5px; margin-bottom:1rem;">
                {{ session('success') }}
            </div>
        @endif

        <div class="welcome-section">
            <h2>¡Bienvenido, {{ Auth::user()->Nombre }}!</h2>
            <p>Has iniciado sesión como <strong>Cliente</strong></p>
        </div>

        <div class="modules-grid">
            <div class="module-card">
                <h3>📱 Mis Servicios</h3>
                <p>Gestiona tus reparaciones y solicitudes de servicio</p>
                <a href="{{ route('servicio.index') }}" class="btn-module">Ver Servicios</a>
            </div>
            
            <div class="module-card">
                <h3>💬 Chat con Técnicos</h3>
                <p>Comunícate con nuestros técnicos</p>
                <a href="{{ route('chat.index') }}" class="btn-module">Ir al Chat</a>
            </div>
            
            <div class="module-card">
                <h3>🛒 Productos</h3>
                <p>Explora nuestro catálogo de productos</p>
                <a href="{{ route('producto.index') }}" class="btn-module">Ver Productos</a>
            </div>
            
            <div class="module-card">
                <h3>👤 Mi Perfil</h3>
                <p>Actualiza tu información personal</p>
                <a href="{{ route('profile') }}" class="btn-module">Editar Perfil</a>
            </div>
        </div>
    </div>
</body>
</html>
