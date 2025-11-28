<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Técnico - Celuaccel</title>
    <style>
        /* Mismos estilos que cliente pero con diferente contenido */
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
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .stat-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #d20000;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Celuaccel - Técnico</h1>
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
            <p>Has iniciado sesión como <strong>Técnico</strong></p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">5</div>
                <div>Servicios Activos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">12</div>
                <div>Completados Hoy</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">3</div>
                <div>En Espera</div>
            </div>
        </div>

        <div class="modules-grid">
            <div class="module-card">
                <h3>🔧 Servicios Asignados</h3>
                <p>Gestiona tus reparaciones asignadas</p>
                <a href="{{ route('servicio.index') }}" class="btn-module">Ver Servicios</a>
            </div>
            
            <div class="module-card">
                <h3>💬 Chat con Clientes</h3>
                <p>Atiende consultas de clientes</p>
                <a href="{{ route('chat.index') }}" class="btn-module">Ir al Chat</a>
            </div>
            
            <div class="module-card">
                <h3>📊 Reportes</h3>
                <p>Genera reportes de trabajo</p>
                <a href="#" class="btn-module">Ver Reportes</a>
            </div>
        </div>
    </div>
</body>
</html>
