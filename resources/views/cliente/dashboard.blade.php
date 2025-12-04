<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente - Celuaccel</title>
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
            --sidebar-collapsed: 70px;
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
        
        .logo-icon {
            font-size: 1.8rem;
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
            font-size: 2rem;
            color: var(--primary-color);
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
        
        /* MÓDULOS PRINCIPALES */
        .modules-title {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin: 30px 0 20px;
        }
        
        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .module-card {
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
        
        .module-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-color);
            box-shadow: 0 12px 25px rgba(210, 0, 0, 0.1);
        }
        
        .module-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: var(--primary-color);
            background: rgba(210, 0, 0, 0.1);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .module-title {
            font-size: 1.3rem;
            margin: 15px 0;
            color: var(--secondary-color);
        }
        
        .module-desc {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
            font-size: 0.95rem;
        }
        
        .module-btn {
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
        
        .module-btn:hover {
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
            
            .modules-grid {
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
    </style>
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
                <a href="/cliente" class="logo">
                    <span class="logo-icon">📱</span>
                    <span class="logo-text">Celuaccel</span>
                </a>
            </div>
            
            <!-- PERFIL DE USUARIO -->
            <div class="user-profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->Nombre, 0, 1)) }}
                </div>
                <div class="user-name">{{ Auth::user()->Nombre }}</div>
                <div class="user-role">CLIENTE</div>
                <div style="margin-top: 10px; font-size: 0.8rem; color: #aaa;">
                    Doc: {{ Auth::user()->ID_Usuario }}
                </div>
            </div>
            
            <!-- MENÚ PRINCIPAL -->
            <nav>
                <ul class="nav-menu">
                    <!-- DASHBOARD -->
                    <li class="nav-item">
                        <a href="/cliente" class="nav-link active">
                            <span class="nav-icon">📊</span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- SERVICIOS (CON SUBMENÚ) -->
                    <li class="nav-item">
                        <a href="#serviciosSubmenu" class="nav-link" id="serviciosToggle">
                            <span class="nav-icon">🔧</span>
                            <span class="nav-text">Mis Servicios</span>
                            <span class="nav-arrow">▼</span>
                        </a>
                        <ul class="submenu" id="serviciosSubmenu">
                            <li class="submenu-item">
                                <a href="/servicios" class="submenu-link">
                                    <span>📋 Ver Todos</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/servicios" class="submenu-link">
                                    <span>➕ Nuevo Servicio</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/servicios" class="submenu-link">
                                    <span>⏳ En Proceso</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/servicios" class="submenu-link">
                                    <span>✅ Completados</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- CHAT Y COMUNICACIÓN -->
                    <li class="nav-item">
                        <a href="#chatSubmenu" class="nav-link" id="chatToggle">
                            <span class="nav-icon">💬</span>
                            <span class="nav-text">Comunicación</span>
                            <span class="nav-arrow">▼</span>
                        </a>
                        <ul class="submenu" id="chatSubmenu">
                            <li class="submenu-item">
                                <a href="/chats" class="submenu-link">
                                    <span>📨 Mis Chats</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/chats" class="submenu-link">
                                    <span>👨‍🔧 Chat con Técnico</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/mensajes" class="submenu-link">
                                    <span>📩 Mensajes</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- PRODUCTOS Y CATÁLOGO -->
                    <li class="nav-item">
                        <a href="#productosSubmenu" class="nav-link" id="productosToggle">
                            <span class="nav-icon">🛒</span>
                            <span class="nav-text">Productos</span>
                            <span class="nav-arrow">▼</span>
                        </a>
                        <ul class="submenu" id="productosSubmenu">
                            <li class="submenu-item">
                                <a href="/productos" class="submenu-link">
                                    <span>📋 Catálogo</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/productos" class="submenu-link">
                                    <span>⭐ Favoritos</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/productos" class="submenu-link">
                                    <span>❓ Mis Preguntas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- SOPORTE Y AYUDA -->
                    <li class="nav-item">
                        <a href="#soporteSubmenu" class="nav-link" id="soporteToggle">
                            <span class="nav-icon">❓</span>
                            <span class="nav-text">Soporte</span>
                            <span class="nav-arrow">▼</span>
                        </a>
                        <ul class="submenu" id="soporteSubmenu">
                            <li class="submenu-item">
                                <a href="/preguntas" class="submenu-link">
                                    <span>📖 FAQ</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/preguntas" class="submenu-link">
                                    <span>📞 Contactar Soporte</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/comentarios" class="submenu-link">
                                    <span>💬 Dejar Comentario</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- CONFIGURACIÓN -->
                    <li class="nav-item">
                        <a href="/profile" class="nav-link">
                            <span class="nav-icon">⚙️</span>
                            <span class="nav-text">Configuración</span>
                        </a>
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
                                <span class="nav-icon">🚪</span>
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
                    ☰
                </button>
                
                <h1 class="page-title">Dashboard Cliente</h1>
                
                <div class="header-actions">
                    <button class="notification-btn">
                        🔔
                        <span class="notification-badge">3</span>
                    </button>
                    
                    <div id="currentTime" style="color: #666; font-weight: bold;">
                        {{ date('H:i') }}
                    </div>
                </div>
            </header>
            
            <!-- MENSAJES -->
            @if(session('success'))
            <div class="alert-message alert-success">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert-message alert-error">
                <span>❌</span>
                <span>{{ session('error') }}</span>
            </div>
            @endif
            
            <!-- TARJETAS DE ESTADÍSTICAS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Servicios Activos</h3>
                        <span class="stat-icon">🔧</span>
                    </div>
                    <div class="stat-value">2</div>
                    <div class="stat-label">Reparaciones en proceso</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Chats Activos</h3>
                        <span class="stat-icon">💬</span>
                    </div>
                    <div class="stat-value">3</div>
                    <div class="stat-label">Conversaciones abiertas</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Productos Vistos</h3>
                        <span class="stat-icon">👁️</span>
                    </div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">En el último mes</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <h3>Satisfacción</h3>
                        <span class="stat-icon">⭐</span>
                    </div>
                    <div class="stat-value">4.8</div>
                    <div class="stat-label">De 5.0 promedio</div>
                </div>
            </div>
            
            <!-- MÓDULOS PRINCIPALES -->
            <h2 class="modules-title">Acciones Rápidas</h2>
            
            <div class="modules-grid">
                <div class="module-card">
                    <div class="module-icon">🔧</div>
                    <h3 class="module-title">Nueva Reparación</h3>
                    <p class="module-desc">Solicita reparación para tu dispositivo móvil. Presupuesto inmediato.</p>
                    <a href="/servicios" class="module-btn">Solicitar</a>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">💬</div>
                    <h3 class="module-title">Chat con Soporte</h3>
                    <p class="module-desc">Habla directamente con nuestros técnicos especializados.</p>
                    <a href="/chats" class="module-btn">Iniciar Chat</a>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">🛒</div>
                    <h3 class="module-title">Tienda Online</h3>
                    <p class="module-desc">Compra repuestos, accesorios y dispositivos nuevos.</p>
                    <a href="/productos" class="module-btn">Ver Tienda</a>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">📅</div>
                    <h3 class="module-title">Mis Citas</h3>
                    <p class="module-desc">Gestiona y agenda citas para servicios en tienda.</p>
                    <a href="/servicios" class="module-btn">Ver Citas</a>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">📄</div>
                    <h3 class="module-title">Mis Facturas</h3>
                    <p class="module-desc">Consulta y descarga tus facturas y comprobantes.</p>
                    <a href="/servicios" class="module-btn">Ver Facturas</a>
                </div>
                
                <div class="module-card">
                    <div class="module-icon">👤</div>
                    <h3 class="module-title">Mi Perfil</h3>
                    <p class="module-desc">Actualiza tu información personal y preferencias.</p>
                    <a href="/profile" class="module-btn">Editar Perfil</a>
                </div>
            </div>
            
            <!-- INFORMACIÓN ADICIONAL -->
            <div style="background: #f9f9f9; padding: 25px; border-radius: 12px; margin-top: 30px;">
                <h3 style="color: var(--secondary-color); margin-bottom: 15px;">📌 Información Importante</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <div>
                        <h4 style="color: var(--primary-color); margin-bottom: 10px;">Horario de Atención</h4>
                        <p style="color: #666;">Lunes a Viernes: 8:00 AM - 6:00 PM<br>Sábados: 9:00 AM - 2:00 PM</p>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-color); margin-bottom: 10px;">Contacto de Emergencia</h4>
                        <p style="color: #666;">📞 01-800-CELUACCEL<br>📧 soporte@celuaccel.com</p>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-color); margin-bottom: 10px;">Estado del Sistema</h4>
                        <p style="color: #666;">✅ <strong>Operativo</strong><br>Todos los servicios funcionando</p>
                    </div>
                </div>
            </div>
            
            <!-- FOOTER -->
            <footer class="footer">
                <p>Sistema Celuaccel &copy; {{ date('Y') }} - Todos los derechos reservados</p>
                <p style="margin-top: 10px; font-size: 0.8rem;">
                    Sesión iniciada como: {{ Auth::user()->Nombre }} | 
                    Último acceso: {{ date('d/m/Y H:i') }} | 
                    <a href="/test-middleware" style="color: var(--primary-color);">Verificar sistema</a>
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
            const serviciosToggle = document.getElementById('serviciosToggle');
            const chatToggle = document.getElementById('chatToggle');
            const productosToggle = document.getElementById('productosToggle');
            const soporteToggle = document.getElementById('soporteToggle');
            
            // SUBMENÚS
            const serviciosSubmenu = document.getElementById('serviciosSubmenu');
            const chatSubmenu = document.getElementById('chatSubmenu');
            const productosSubmenu = document.getElementById('productosSubmenu');
            const soporteSubmenu = document.getElementById('soporteSubmenu');
            
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
            serviciosToggle.addEventListener('click', function(e) {
                e.preventDefault();
                serviciosSubmenu.classList.toggle('active');
                this.querySelector('.nav-arrow').textContent = 
                    serviciosSubmenu.classList.contains('active') ? '▲' : '▼';
            });
            
            chatToggle.addEventListener('click', function(e) {
                e.preventDefault();
                chatSubmenu.classList.toggle('active');
                this.querySelector('.nav-arrow').textContent = 
                    chatSubmenu.classList.contains('active') ? '▲' : '▼';
            });
            
            productosToggle.addEventListener('click', function(e) {
                e.preventDefault();
                productosSubmenu.classList.toggle('active');
                this.querySelector('.nav-arrow').textContent = 
                    productosSubmenu.classList.contains('active') ? '▲' : '▼';
            });
            
            soporteToggle.addEventListener('click', function(e) {
                e.preventDefault();
                soporteSubmenu.classList.toggle('active');
                this.querySelector('.nav-arrow').textContent = 
                    soporteSubmenu.classList.contains('active') ? '▲' : '▼';
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
            
            // CERRAR SUBMENÚS AL HACER CLICK FUERA
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 1024) {
                    if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                        sidebar.classList.remove('active');
                        sidebarOverlay.classList.remove('active');
                    }
                }
            });
            
            // SIMULAR NOTIFICACIONES
            const notificationBtn = document.querySelector('.notification-btn');
            const notificationBadge = document.querySelector('.notification-badge');
            
            notificationBtn.addEventListener('click', function() {
                alert('Tienes 3 notificaciones:\n1. Servicio #001 completado\n2. Nuevo mensaje del técnico\n3. Oferta especial en accesorios');
                notificationBadge.textContent = '0';
                notificationBadge.style.display = 'none';
            });
            
            // RESALTAR ELEMENTO ACTIVO EN MENÚ
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link, .submenu-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath || 
                    (link.getAttribute('href') !== '#' && currentPath.includes(link.getAttribute('href')))) {
                    link.classList.add('active');
                    
                    // ABRIR SUBMENÚ PADRE SI ES NECESARIO
                    const parentSubmenu = link.closest('.submenu');
                    if (parentSubmenu) {
                        parentSubmenu.classList.add('active');
                        const toggleBtn = document.querySelector(`[href="#${parentSubmenu.id}"]`);
                        if (toggleBtn) {
                            toggleBtn.querySelector('.nav-arrow').textContent = '▲';
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
