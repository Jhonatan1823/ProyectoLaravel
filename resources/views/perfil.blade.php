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
        <a  href="{{ route('welcome') }}" style="text-decoration:none;color: white;"><h1 class="navbar-brand" style="text-decoration:none;color: white;">Celuaccel</h1></a>
      </div>
      <div class="ms-auto">
    <div>
    </div>
    @if(session()->has('user'))
    <span class="nav-link text-white">
            ¡Bienvenido, {{ session('user.Nombre') }}!
    </span>
    @endif
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-light" style="color:red">
            Cerrar sesión
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color:#d20000;">
             <h5 class="mb-0"><i class="fa-solid fa-user-pen"></i> Editar Perfil</h5>
        </div>
        <div class="card-body">
            <form id="perfilForm" action="{{ route('perfil.update') }}" method="POST">
                @csrf
                @method('PUT')


                <div class="mb-3">
                    <label for="perfilID_Usuario" class="form-label">ID Usuario</label>
                    <input type="text" class="form-control" id="perfilID_Usuario" value="{{ $usuario->ID_Usuario }}" readonly>
                </div>


                <div class="mb-3">
                    <label for="perfilCodigo_Documento" class="form-label">Tipo Documento</label>
                    <select class="form-select" id="perfilCodigo_Documento" name="Codigo_Documento" required>
                        <option value="2" {{ old('Codigo_Documento', $usuario->Codigo_Documento) == 2 ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                        <option value="1" {{ old('Codigo_Documento', $usuario->Codigo_Documento) == 1 ? 'selected' : '' }}>Tarjeta de Identidad</option>
                        <option value="3" {{ old('Codigo_Documento', $usuario->Codigo_Documento) == 3 ? 'selected' : '' }}>Pasaporte</option>
                        <option value="4" {{ old('Codigo_Documento', $usuario->Codigo_Documento) == 4 ? 'selected' : '' }}>NIT</option>
                        <option value="5" {{ old('Codigo_Documento', $usuario->Codigo_Documento) == 5 ? 'selected' : '' }}>PEP</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="perfilNombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="perfilNombre" name="Nombre" value="{{ old('Nombre', $usuario->Nombre) }}" required>
                </div>


                <div class="mb-3">
                    <label for="perfilFecha_Nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="perfilFecha_Nacimiento" name="Fecha_Nacimiento" value="{{ old('Fecha_Nacimiento', $usuario->Fecha_Nacimiento) }}" required>
                </div>


                <div class="mb-3">
                    <label for="perfilDireccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="perfilDireccion" name="Direccion" value="{{ old('Direccion', $usuario->Direccion) }}" required>
                </div>

                <div class="mb-3">
                    <label for="perfilTelefono" class="form-label">Teléfono</label>
                    <input type="number" class="form-control" id="perfilTelefono" name="Telefono" value="{{ old('Telefono', $usuario->Telefono) }}" required>
                </div>

                <div class="mb-3">
                    <label for="perfilCorreo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="perfilCorreo" name="Correo" value="{{ old('Correo', $usuario->Correo) }}" required>
                </div>

                <div class="mb-3">
                    <label for="perfilContraseña" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="perfilContraseña" name="Contraseña">
                </div>
                <div class="mb-3">
                    <label for="perfilContraseña_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="perfilContraseña_confirmation" name="Contraseña_confirmation">
                </div>


                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" style="background-color:#d20000;">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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
            @if(!session()->has('user'))
            <h5 class="text-white mb-3">Inicia Sesion Para Navegar por el Sistema</h5>
            <div class="accordion accordion-flush" id="dbAccordion">
            @endif
            @if(session()->has('user'))
            <h5 class="text-white mb-3">Modulos</h5>
            <div class="accordion accordion-flush" id="dbAccordion">

@php
$rol = session('user.Codigo_Rol');
@endphp
@if($rol == 2 or $rol == 3)
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
                            @if($rol == 3)
                            <a href="{{ route('categoria.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-tags me-2"></i> Categorías</a>
                            @endif
                        </div>
                    </div>
                </div>
@endif

@if($rol == 2 or $rol == 3)
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

@if($rol == 1 or $rol == 3)
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

                {{-- MÓDULO 4: COMUNICACIÓN --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-envelope me-2"></i> Comunicación
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            @if($rol == 1 or $rol == 3)<a href="{{ route('chat.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-comments-dollar me-2"></i> Chat</a>@endif
                            <a href="{{ route('protochat') }}" class="list-group-item list-group-item-action"><i class="fas fa-comments-dollar me-2"></i> Simulación Chat</a>
                            @if($rol == 1 or $rol == 3)<a href="{{ route('mensajes.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-paper-plane me-2"></i> Mensajes</a>@endif
                            <a href="{{ route('notificaciones.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-bell me-2"></i> Notificaciones</a>
                        </div>
                    </div>
                </div>


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
                {{-- MÓDULO 6: Perfil--}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-users-cog me-2"></i> Usuario
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('perfil') }}" class="list-group-item list-group-item-action"><i class="fas fa-user me-2"></i> Perfil</a>
                        </div>
                    </div>
                </div>                          
@endif
            </div>
        </div>
</div>