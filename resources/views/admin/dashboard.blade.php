<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Celuaccel</title>
    <style>
        /* VARIABLES DE COLOR */
        :root {
            --primary-color: #d20000;
            --primary-dark: #a00000;
            --secondary-color: #1c1c1c;
            --background-color: #ffffff;
            --text-color: #333333;
            --light-gray: #f5f5f5;
            --border-color: #e0e0e0;
            --sidebar-width: 250px;
        }
        
        /* RESET Y ESTILOS BASE */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        
        body {
            background-color: var(--background-color);
            color: var(--text-color);
            overflow-x: hidden;
        }
        
        /* CONTENEDOR PRINCIPAL */
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* ========== SIDEBAR / MENÚ LATERAL ========== */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--secondary-color);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        
        .logo {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }
        
        .user-profile {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .user-avatar {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }
        
        .user-name {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }
        
        .user-role {
            background: var(--primary-color);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
        }
        
        /* MENÚ DE NAVEGACIÓN */
        .nav-menu {
            padding: 20px 0;
        }
        
        .nav-item {
            list-style: none;
            margin-bottom: 5px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(210, 0, 0, 0.1);
            color: white;
            border-left-color: var(--primary-color);
        }
        
        .nav-icon {
            font-size: 1.2rem;
            min-width: 25px;
            text-align: center;
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        
        .nav-text {
            flex: 1;
        }
        
        /* SUBMENÚ */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: rgba(0,0,0,0.2);
        }
        
        .submenu.active {
            max-height: 500px;
        }
        
        .submenu-item {
            list-style: none;
        }
        
        .submenu-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px 12px 50px;
            color: #aaa;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.9rem;
        }
        
        .submenu-link:hover {
            background-color: rgba(210, 0, 0, 0.05);
            color: white;
        }
        
        /* ========== CONTENIDO PRINCIPAL ========== */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        
        /* HEADER SUPERIOR */
        .top-header {
            background-color: white;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .menu-toggle {
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.5rem;
            cursor: pointer;
            display: none;
        }
        
        .page-title {
            font-size: 1.8rem;
            color: var(--secondary-color);
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .notification-btn {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.2rem;
            cursor: pointer;
            position: relative;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--primary-color);
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* TARJETAS DE ESTADÍSTICAS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-top: 5px solid var(--primary-color);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            font-size: 1.8rem;
            color: var(--primary-color);
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--secondary-color);
            line-height: 1;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        
        /* MÓDULOS ADMINISTRATIVOS */
        .admin-title {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin: 30px 0 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .admin-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .admin-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .admin-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-color);
            box-shadow: 0 12px 25px rgba(210, 0, 0, 0.1);
        }
        
        .admin-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--primary-color);
            background: rgba(210, 0, 0, 0.1);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        
        .admin-card h3 {
            font-size: 1.3rem;
            margin: 15px 0;
            color: var(--secondary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            width: 100%;
        }
        
        .admin-desc {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
            font-size: 0.95rem;
            flex-grow: 1;
        }
        
        .admin-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 200px;
        }
        
        .admin-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
        }
        
        /* MENSAJES */
        .alert-message {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .alert-success {
            background: #e6ffe6;
            border: 1px solid #99ff99;
            color: #008000;
        }
        
        .alert-error {
            background: #ffe6e6;
            border: 1px solid #ffb3b3;
            color: #d20000;
        }
        
        /* FOOTER */
        .footer {
            text-align: center;
            margin-top: 50px;
            padding: 25px;
            color: #666;
            border-top: 1px solid var(--border-color);
            font-size: 0.9rem;
        }
        
        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .admin-grid {
                grid-template-columns: 1fr;
            }
            
            .top-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .header-actions {
                width: 100%;
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .stat-card {
                padding: 20px;
            }
            
            .stat-value {
                font-size: 2rem;
            }
            
            .main-content {
                padding: 15px;
            }
        }
        
        /* OVERLAY PARA MÓVIL */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        .sidebar-overlay.active {
            display: block;
        }
        
        /* TABLA DE ACTIVIDAD RECIENTE */
        .activity-table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-top: 30px;
        }
        
        .activity-table th {
            background: var(--secondary-color);
            color: white;
            padding: 15px;
            text-align: left;
        }
        
        .activity-table td {
            padding: 15px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .activity-table tr:hover {
            background-color: rgba(210, 0, 0, 0.05);
        }
        
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .badge-success {
            background: #e6ffe6;
            color: #008000;
        }
        
        .badge-warning {
            background: #fff8e6;
            color: #ff9800;
        }
        
        .badge-danger {
            background: #ffe6e6;
            color: #d20000;
        }
    </style>
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <!-- OVERLAY PARA MÓVIL -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="app-container">
        
        <!-- ========== SIDEBAR / MENÚ LATERAL ========== -->
        <aside class="sidebar" id="sidebar">
            <!-- LOGO Y TOGGLE -->
            <div class="sidebar-header">
                <a href="/admin" class="logo">
                    <span class="logo-text">Celuaccel</span>
                </a>
            </div>
            
            <!-- PERFIL DE USUARIO -->
            <div class="user-profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->Nombre, 0, 1)) }}
                </div>
                <div class="user-name">{{ Auth::user()->Nombre }}</div>
                <div class="user-role">ADMINISTRADOR</div>
                <div style="margin-top: 10px; font-size: 0.8rem; color: #aaa;">
                    Doc: {{ Auth::user()->ID_Usuario }}
                </div>
            </div>
            
            <!-- MENÚ PRINCIPAL -->
            <nav>
                <ul class="nav-menu">
                    <!-- DASHBOARD -->
                    <li class="nav-item">
                        <a href="/admin" class="nav-link active">
                            <span class="nav-icon"><i class="fas fa-tachometer-alt"></i></span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- GESTIÓN DE USUARIOS -->
                    <li class="nav-item">
                        <a href="#usuariosSubmenu" class="nav-link" id="usuariosToggle">
                            <span class="nav-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-text">Usuarios</span>
                            <span class="nav-arrow">▼</span>
                        </a>
                        <ul class="submenu" id="usuariosSubmenu">
                            <li class="submenu-item">
                                <a href="{{ route('admin.usuarios.index') }}" class="submenu-link">
                                    <span>Gestionar Usuarios</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- GESTIÓN DE PRODUCTOS -->
                    <li class="nav-item">
                        <a href="#productosSubmenu" class="nav-link" id="productosToggle">
                            <span class="nav-icon"><i class="fas fa-box"></i></span>
                            <span class="nav-text">Productos</span>
                            <span class="nav-arrow">▼</span>
                        </a>
                        <ul class="submenu" id="productosSubmenu">
                            <li class="submenu-item">
                                <a href="{{ route('admin.productos.index') }}" class="submenu-link">
                                    <span>Gestionar Productos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- GESTIÓN DE SERVICIOS -->
                    <li class="nav-item">
                        <a href="#serviciosSubmenu" class="nav-link" id="serviciosToggle">
                            <span class="nav-icon"><i class="fas fa-tools"></i></span>
                            <span class="nav-text">Servicios</span>
                            <span class="nav-arrow">▼</span>
                        </a>
                        <ul class="submenu" id="serviciosSubmenu">
                            <li class="submenu-item">
                                <a href="{{ route('servicios.index') }}" class="submenu-link">
                                    <span>Todos los Servicios</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- CATEGORÍAS Y CONFIGURACIONES -->
                    <li class="nav-item">
                        <a href="#configSubmenu" class="nav-link" id="configToggle">
                            <span class="nav-icon"><i class="fas fa-cogs"></i></span>
                            <span class="nav-text">Configuraciones</span>
                            <span class="nav-arrow">▼</span>
                        </a>
                        <ul class="submenu" id="configSubmenu">
                            <li class="submenu-item">
                                <a href="{{ route('admin.categorias.index') }}" class="submenu-link">
                                    <span>Categorías</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('admin.roles.index') }}" class="submenu-link">
                                    <span>Roles</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('admin.tipos.index') }}" class="submenu-link">
                                    <span>Tipos de Documento</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- SEPARADOR -->
                    <li style="padding: 20px; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 20px;">
                        <small style="color: #aaa;">Sistema Celuaccel v1.0</small>
                    </li>
                    
                    <!-- LOGOUT -->
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: block;">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                                <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                                <span class="nav-text">Cerrar Sesión</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>
        
        <!-- ========== CONTENIDO PRINCIPAL ========== -->
        <main class="main-content">
            <!-- HEADER SUPERIOR -->
            <header class="top-header">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <h1 class="page-title">Panel de Administración</h1>
                
                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">5</span>
                    </button>
                    
                    <div id="currentTime" style="color: #666; font-weight: bold;">
                        {{ date('H:i') }}
                    </div>
                </div>
            </header>
            
            <!-- MENSAJES -->
            @if(session('success'))
            <div class="alert-message alert-success">
                <span><i class="fas fa-check-circle"></i></span>
                <span>{{ session('success') }}</span>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert-message alert-error">
                <span><i class="fas fa-exclamation-circle"></i></span>
                <span>{{ session('error') }}</span>
            </div>
            @endif
            
            <!-- BIENVENIDA -->
            <div style="background: #f9f9f9; padding: 25px; border-radius: 12px; margin-bottom: 30px;">
                <h2 style="color: var(--secondary-color); margin-bottom: 10px;">
                    <i class="fas fa-user-shield" style="color: var(--primary-color);"></i> 
                    ¡Bienvenido, {{ Auth::user()->Nombre }}!
                </h2>
                <p style="color: #666; font-size: 1.1rem;">
                    Has iniciado sesión como <strong>Administrador</strong> | 
                    Documento: {{ Auth::user()->ID_Usuario }} |
                    Último acceso: {{ date('d/m/Y H:i') }}
                </p>
            </div>
            
            <!-- TARJETAS DE ESTADÍSTICAS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Usuarios Totales</h3>
                        <span class="stat-icon"><i class="fas fa-users"></i></span>
                    </div>
                    <div class="stat-value">156</div>
                    <div class="stat-label">Usuarios registrados</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Servicios Activos</h3>
                        <span class="stat-icon"><i class="fas fa-tools"></i></span>
                    </div>
                    <div class="stat-value">42</div>
                    <div class="stat-label">En proceso hoy</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Ingresos Mensuales</h3>
                        <span class="stat-icon"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <div class="stat-value">$25,430</div>
                    <div class="stat-label">Total del mes</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Satisfacción</h3>
                        <span class="stat-icon"><i class="fas fa-chart-line"></i></span>
                    </div>
                    <div class="stat-value">96%</div>
                    <div class="stat-label">Tasa general</div>
                </div>
            </div>
            
            <!-- MÓDULOS DE ADMINISTRACIÓN -->
            <h2 class="admin-title">
                <i class="fas fa-cogs"></i> Módulos de Administración
            </h2>
            
            <div class="admin-grid">
                <div class="admin-card">
                    <div class="admin-icon"><i class="fas fa-users"></i></div>
                    <h3>Gestión de Usuarios</h3>
                    <p class="admin-desc">Administra todos los usuarios del sistema, asigna roles y permisos.</p>
                    <a href="{{ route('admin.usuarios.index') }}" class="admin-btn">Gestionar</a>
                </div>
                
                <div class="admin-card">
                    <div class="admin-icon"><i class="fas fa-box"></i></div>
                    <h3>Gestión de Productos</h3>
                    <p class="admin-desc">Controla el catálogo de productos, inventario y precios.</p>
                    <a href="{{ route('admin.productos.index') }}" class="admin-btn">Gestionar</a>
                </div>
                
                <div class="admin-card">
                    <div class="admin-icon"><i class="fas fa-tools"></i></div>
                    <h3>Gestión de Servicios</h3>
                    <p class="admin-desc">Supervisa todos los servicios y reparaciones en proceso.</p>
                    <a href="{{ route('servicios.index') }}" class="admin-btn">Ver Servicios</a>
                </div>
                
                <div class="admin-card">
                    <div class="admin-icon"><i class="fas fa-tags"></i></div>
                    <h3>Categorías</h3>
                    <p class="admin-desc">Gestiona las categorías de productos y servicios.</p>
                    <a href="{{ route('admin.categorias.index') }}" class="admin-btn">Gestionar</a>
                </div>
                
                <div class="admin-card">
                    <div class="admin-icon"><i class="fas fa-user-tag"></i></div>
                    <h3>Roles y Permisos</h3>
                    <p class="admin-desc">Administra los roles del sistema y sus permisos.</p>
                    <a href="{{ route('admin.roles.index') }}" class="admin-btn">Gestionar</a>
                </div>
                
                <div class="admin-card">
                    <div class="admin-icon"><i class="fas fa-file-alt"></i></div>
                    <h3>Tipos de Documento</h3>
                    <p class="admin-desc">Configura los tipos de documento para usuarios.</p>
                    <a href="{{ route('admin.tipos.index') }}" class="admin-btn">Configurar</a>
                </div>
            </div>
            
            <!-- FOOTER -->
            <footer class="footer">
                <p>Sistema Celuaccel &copy; {{ date('Y') }} - Todos los derechos reservados</p>
                <p style="margin-top: 10px; font-size: 0.8rem;">
                    Versión: 1.0.0 | 
                    Usuarios activos: 24 | 
                    Servicios hoy: 42
                </p>
            </footer>
        </main>
    </div>
    
    <!-- SCRIPT PARA FUNCIONALIDAD -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ELEMENTOS DEL DOM
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menuToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            // TOGGLES DE SUBMENÚ
            const usuariosToggle = document.getElementById('usuariosToggle');
            const productosToggle = document.getElementById('productosToggle');
            const serviciosToggle = document.getElementById('serviciosToggle');
            const configToggle = document.getElementById('configToggle');
            
            // SUBMENÚS
            const usuariosSubmenu = document.getElementById('usuariosSubmenu');
            const productosSubmenu = document.getElementById('productosSubmenu');
            const serviciosSubmenu = document.getElementById('serviciosSubmenu');
            const configSubmenu = document.getElementById('configSubmenu');
            
            // TOGGLE SIDEBAR EN MÓVIL
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
            });
            
            // CERRAR SIDEBAR AL HACER CLICK EN OVERLAY
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
            
            // TOGGLE SUBMENÚS
            usuariosToggle.addEventListener('click', function(e) {
                e.preventDefault();
                usuariosSubmenu.classList.toggle('active');
                this.querySelector('.nav-arrow').textContent = 
                    usuariosSubmenu.classList.contains('active') ? '▲' : '▼';
            });
            
            productosToggle.addEventListener('click', function(e) {
                e.preventDefault();
                productosSubmenu.classList.toggle('active');
                this.querySelector('.nav-arrow').textContent = 
                    productosSubmenu.classList.contains('active') ? '▲' : '▼';
            });
            
            serviciosToggle.addEventListener('click', function(e) {
                e.preventDefault();
                serviciosSubmenu.classList.toggle('active');
                this.querySelector('.nav-arrow').textContent = 
                    serviciosSubmenu.classList.contains('active') ? '▲' : '▼';
            });
            
            configToggle.addEventListener('click', function(e) {
                e.preventDefault();
                configSubmenu.classList.toggle('active');
                this.querySelector('.nav-arrow').textContent = 
                    configSubmenu.classList.contains('active') ? '▲' : '▼';
            });
            
            // ACTUALIZAR HORA EN TIEMPO REAL
            function updateTime() {
                const now = new Date();
                const timeElement = document.getElementById('currentTime');
                if (timeElement) {
                    timeElement.textContent = now.toLocaleTimeString('es-ES', { 
                        hour: '2-digit', 
                        minute: '2-digit',
                        second: '2-digit'
                    });
                }
            }
            
            // ACTUALIZAR CADA SEGUNDO
            updateTime();
            setInterval(updateTime, 1000);
        });
    </script>
</body>
</html>
