<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<body>

<!--Barra de navegacion de arriba-->
<nav class="navbar navbar-expand-lg" style="background-color: #d20000ff;">
  <div class="container-fluid">
    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" style="outline: none; box-shadow: none; border-color: transparent; background-color: #1c1c1cff">
      <i class="fa-solid fa-bars"></i>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <h1 style="color: white;">Celuaccel</h1>
      </div>
      <div class="ms-auto">
@if(!session()->has('user'))
    <a href="{{ route('iniciosesion') }}" class="btn btn-primary">
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
  </div>
</nav>

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
@if($rol == 2)
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

@if($rol == 2)
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

@if($rol == 3)
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

@if($rol == 2)
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

@if($rol == 1)
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
   




