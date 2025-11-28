<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Celuaccel</title>
    <style>
        .admin-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .admin-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .admin-card h3 {
            color: #d20000;
            border-bottom: 2px solid #d20000;
            padding-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Celuaccel - Administrador</h1>
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
            <p>Has iniciado sesión como <strong>Administrador</strong></p>
        </div>

        <div class="admin-grid">
            <div class="admin-card">
                <h3>👥 Gestión de Usuarios</h3>
                <p>Administra usuarios del sistema</p>
                <a href="{{ route('usuario.index') }}" class="btn-module">Gestionar Usuarios</a>
            </div>
            
            <div class="admin-card">
                <h3>📦 Gestión de Productos</h3>
                <p>Administra catálogo de productos</p>
                <a href="{{ route('producto.index') }}" class="btn-module">Gestionar Productos</a>
            </div>
            
            <div class="admin-card">
                <h3>🔧 Gestión de Servicios</h3>
                <p>Supervisa todos los servicios</p>
                <a href="{{ route('servicio.index') }}" class="btn-module">Ver Servicios</a>
            </div>
            
            <div class="admin-card">
                <h3>📊 Reportes del Sistema</h3>
                <p>Reportes y estadísticas</p>
                <a href="#" class="btn-module">Ver Reportes</a>
            </div>
            
            <div class="admin-card">
                <h3>🏷️ Categorías</h3>
                <p>Gestiona categorías de productos</p>
                <a href="{{ route('categoria.index') }}" class="btn-module">Gestionar Categorías</a>
            </div>
            
            <div class="admin-card">
                <h3>👤 Roles</h3>
                <p>Administra roles del sistema</p>
                <a href="{{ route('roles.index') }}" class="btn-module">Gestionar Roles</a>
            </div>
        </div>
    </div>
</body>
</html>
