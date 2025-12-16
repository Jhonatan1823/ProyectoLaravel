<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celuaccel - Inicio</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Estilos profesionales - Blanco y Rojo */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            color: #333;
            line-height: 1.6;
        }

        /* Header/Navbar */
        .navbar {
            background: #d20000;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-login {
            background: white;
            color: #d20000;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login:hover {
            background: #f8f8f8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
            padding: 5rem 2rem;
            text-align: center;
        }

        .hero h1 {
            color: #d20000;
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 800;
        }

        .hero p {
            font-size: 1.2rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto 2rem;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: #d20000;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #b30000;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(210, 0, 0, 0.2);
        }

        .btn-secondary {
            background: white;
            color: #d20000;
            border: 2px solid #d20000;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            background: #d20000;
            color: white;
        }

        /* Features Section */
        .features {
            padding: 5rem 2rem;
            background: white;
        }

        .section-title {
            text-align: center;
            color: #d20000;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            font-weight: 700;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .feature-icon {
            font-size: 3rem;
            color: #d20000;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .feature-card p {
            color: #666;
        }

        /* Services Section */
        .services {
            padding: 5rem 2rem;
            background: #fff5f5;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
            text-align: center;
            border-top: 4px solid #d20000;
        }

        .service-card h3 {
            color: #d20000;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        /* CTA Section */
        .cta {
            background: #d20000;
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .cta p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 3rem 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section h3 {
            color: #d20000;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer-section p, .footer-section a {
            color: #ccc;
            margin-bottom: 0.5rem;
            text-decoration: none;
            display: block;
        }

        .footer-section a:hover {
            color: white;
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid #333;
            color: #999;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .nav-links {
                flex-direction: column;
                gap: 1rem;
                width: 100%;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
                max-width: 300px;
            }

            .section-title {
                font-size: 2rem;
            }

        }

        @media (max-width: 480px) {
            .hero {
                padding: 3rem 1rem;
            }

            .features, .services, .cta {
                padding: 3rem 1rem;
            }

            .hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #d20000ff;">
  <div class="container-fluid">
    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" style="outline: none; box-shadow: none; border-color: transparent; background-color: #1c1c1cff">
      <i class="fa-solid fa-bars"></i>
    </a>
    <div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a  href="{{ route('welcome') }}"><h1 class="navbar-brand" style="color: white;">Celuaccel</h1></a>
      </div>            
      <a href="#inicio" class="nav-link">Inicio</a>
            <a href="#servicios" class="nav-link">Servicios</a>
            <a href="#caracteristicas" class="nav-link">Características</a>
            <a href="#contacto" class="nav-link">Contacto</a>
      <div class="ms-auto">
@if(!session()->has('user'))
    <a href="{{ route('iniciosesion') }}" class="btn btn-login">
        Iniciar sesión
    </a>
@endif
@if(session()->has('user'))
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
        </button>
    </form>
@endif
      </div>
    </div>
  </>
</nav>

    <!-- Hero Section -->
    <section class="hero" id="inicio">
        <h1>Reparación de Celulares Profesional</h1>
        <p>Tu dispositivo en las mejores manos. Servicio técnico especializado, repuestos originales y garantía en todos nuestros servicios. ¡Recupera tu dispositivo en tiempo récord!</p>
        <div class="hero-buttons">
            <a href="{{ route('iniciosesion') }}" class="btn-primary">Iniciar Sesión en el Sistema</a>
            <a href="#servicios" class="btn-secondary">Ver Nuestros Servicios</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="caracteristicas">
        <h2 class="section-title">¿Por qué elegir Celuaccel?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-forward"></i></div>
                <h3>Reparación Rápida</h3>
                <p>Servicio express con tiempos de entrega optimizados. La mayoría de las reparaciones se completan en menos de 24 horas.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-user-shield"></i></div>
                <h3>Garantía Extendida</h3>
                <p>Todos nuestros servicios incluyen garantía de 90 días. Confianza y seguridad en cada reparación.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                <h3>Técnicos Certificados</h3>
                <p>Profesionales con certificación en las principales marcas del mercado. Expertos en tecnología móvil.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-star"></i></div>
                <h3>Repuestos Originales</h3>
                <p>Utilizamos solamente componentes originales y de alta calidad para garantizar el mejor funcionamiento.</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="servicios">
        <h2 class="section-title">Nuestros Servicios</h2>
        <div class="services-grid">
            <div class="service-card">
                <h3>Cambio de Pantalla</h3>
                <p>Pantallas rotas o con líneas. Reparación profesional con cristales originales.</p>
            </div>
            <div class="service-card">
                <h3>Reparación de Batería</h3>
                <p>Baterías con poca duración o que no cargan. Reemplazo con baterías de alta capacidad.</p>
            </div>
            <div class="service-card">
                <h3>Sistema de Carga</h3>
                <p>Problemas con puertos de carga, conectores o circuitos de energía.</p>
            </div>
            <div class="service-card">
                <h3>Cámaras y Audio</h3>
                <p>Reparación de cámaras, altavoces, micrófonos y conectores de auriculares.</p>
            </div>
            <div class="service-card">
                <h3>Mantenimiento General</h3>
                <p>Limpieza interna, cambio de pasta térmica y optimización del sistema.</p>
            </div>
            <div class="service-card">
                <h3>Recuperación de Datos</h3>
                <p>Rescate de información importante de dispositivos dañados.</p>
            </div>
            <div class="service-card">
                <h3>Otros</h3>
                <p>Algun otro servicio que no caiga en otra categoria.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>¿Listo para reparar tu dispositivo?</h2>
        <p>Accede a nuestro sistema de gestión para solicitar servicios, hacer seguimiento a tus reparaciones y comunicarte con nuestros técnicos.</p>
        <a href="{{ route('iniciosesion') }}" class="btn-primary" style="background: white; color: #d20000;">Acceder al Sistema</a>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contacto">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Celuaccel</h3>
                <p>Especialistas en reparación de dispositivos móviles con más de 10 años de experiencia en el mercado.</p>
            </div>
            <div class="footer-section">
                <h3>Contacto</h3>
                <p><i class="fa-solid fa-phone"></i> +57 123 456 7890</p>
                <p><i class="fa-solid fa-envelope"></i> info@celuaccel.com</p>
                <p><i class="fa-solid fa-map-pin"></i> Calle 123 #45-67, Bogotá</p>
            </div>
            <div class="footer-section">
                <h3>Horarios</h3>
                <p>Lunes a Viernes: 8AM - 7PM</p>
                <p>Sábados: 9AM - 2PM</p>
                <p>Domingos: Cerrado</p>
            </div>
            <div class="footer-section">
                <h3>Acceso Rápido</h3>
                <a href="{{ route('iniciosesion') }}">Iniciar Sesión</a>
                <a href="#servicios">Nuestros Servicios</a>
                <a href="#caracteristicas">Características</a>
            </div>
        </div>
        <div class="copyright">
            © 2024 Celuaccel. Todos los derechos reservados. Sistema desarrollado para gestión de reparaciones.
        </div>
    </footer>

    <script>
        // Smooth scrolling para enlaces internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar efecto scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
            } else {
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            }
        });
    </script>
</body>
</html>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color:#1c1c1cff">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" style="color:white;" id="offcanvasExampleLabel">Menú</h5>

    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

</div>
  <div class="offcanvas-body">
        <div class="container mt-5">
<div class="sidebar">
        <div class="p-3">
            <h5 class="text-white mb-3">Inicia Sesion Para Navegar por el Sistema</h5>
            <div class="accordion accordion-flush" id="dbAccordion">
@php
$rol = session('user.Codigo_Rol');
@endphp
@if($rol == 2 || $rol == 3 || $rol == 1)
                {{-- MÓDULO 1: CATÁLOGO --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-mobile-alt me-2"></i> Catálogo
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('producto.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-box me-2"></i> Productos</a>
                            <a href="{{ route('categoria.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-tags me-2"></i> Categorías</a>
                        </div>
                    </div>
                </div>
@endif

@if($rol == 2 || $rol == 1 || $rol ==3)
                {{-- MÓDULO 2: INTERACCIÓN --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-comments me-2"></i> Interacción
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('pregunta.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-question-circle me-2"></i> Preguntas</a>
                            <a href="{{ route('comentarios.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-star me-2"></i> Comentarios</a>
                        </div>
                    </div>
                </div>
@endif

@if($rol == 1 || $rol == 3)
                {{-- MÓDULO 3: SERVICIOS --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-wrench me-2"></i> Servicios
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('servicio.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-tools me-2"></i> Servicios Activos</a>
                            <a href="{{ route('adminservicio') }}" class="list-group-item list-group-item-action"><i class="fas fa-tools me-2"></i> Simulacion Servicios (Vista de Tecnicos)</a>
                            <a href="{{ route('historial.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-history me-2"></i> Historial</a>
                        </div>
                    </div>
                </div>
@endif

@if($rol == 2 || $rol == 1 || $rol == 3
)
                {{-- MÓDULO 4: COMUNICACIÓN --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-envelope me-2"></i> Comunicación
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('chat.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-comments-dollar me-2"></i> Chat</a>
                            <a href="{{ route('protochat') }}" class="list-group-item list-group-item-action"><i class="fas fa-comments-dollar me-2"></i> Simulación Chat</a>
                            <a href="{{ route('mensajes.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-paper-plane me-2"></i> Mensajes</a>
                            <a href="{{ route('notificaciones.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-bell me-2"></i> Notificaciones</a>
                        </div>
                    </div>
                </div>
@endif

@if($rol == 3)
                {{-- MÓDULO 5: GESTIÓN BASE (Usuarios y Roles) --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-users-cog me-2"></i> Gestión Base
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('usuario.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-user me-2"></i> Usuarios</a>
                            <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-user-tag me-2"></i> Roles</a>
                            <a href="{{ route('tipo.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-id-card me-2"></i> Tipos de Documento</a>
                        </div>
                    </div>
                </div>
@endif               
            </div>
        </div>
</div>



