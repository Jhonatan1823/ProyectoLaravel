<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo Historial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<body style="background-color: #ffffffff;">
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
      </div>@if(session()->has('user'))
      <span class="nav-link text-white">
            ¡Bienvenido, {{ session('user.Nombre') }}!
        </span>@endif
      <div class="ms-auto">
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

    <container class="container-sm d-flex justify-content-center mt-5">
        <div class="card">
            <div class="card-body" style="width: 1200px;">
                <h3>Modulo Historial</h3>
                <hr>
                {{-- Mensaje de éxito --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Mensaje de error general --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Errores de validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fa-solid fa-circle-xmark"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                <form name="historial_servicios" action="{{ url('/historial_servicios') }}" method="GET">
                    <div class="text-end mb-3">
                        <button type="button" style="background-color:red;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarModal"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" name="search" value="{{ request ('search') }}" placeholder="Buscar por ID_historial o Fecha" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-success edit-btn" style="background-color:red;"><i class="fas fa-search-plus"></i> Buscar</button>
                            <a href="{{ url('/historial_servicios') }}">
                                <button type="button" class="btn btn-success edit-btn" style="background-color:#1c1c1cff"><i class="fas fa-list"></i> Reset</button>
                            </a>
                        </div>
                    </div>

                </form>
                <!--Cuenta los datos-->
                @if($datos->count() > 0)
                            <table class="table table-striped table-hover table-bordered ">
                                    <thead class="table-primary">
                                        <tr>
                                        <th scope="col">Codigo del historial</th>
                                        <th scope="col">Codigo del servicio</th>
                                        <th scope="col">Fecha del historial</th>
                                        <th scope="col">Descripcion del historial</th>
                                         <th scope="col">Estado del historial</th>
                                        <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datos as $item)
                                        <tr>
                                            <td>{{$item->ID_Historial}}</td>
                                            <td>{{$item->ID_Servicio}}</td>
                                            <td>{{$item->Fecha_Evento}}</td>
                                            <td>{{$item->Descripcion_Evento}}</td>
                                            <td>
                                                @if($item->Estado == '1')
                                                Activo
                                                @endif
                                                @if($item->Estado == '0')
                                                Inactivo
                                                @endif
                                            </td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-success edit-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#EditarModal"
                                                    data-id="{{ $item->ID_Historial }}"
                                                    data-idServ="{{ $item->ID_Servicio }}"
                                                    data-fecha="{{ $item->Fecha_Evento }}"
                                                    data-desc="{{ $item->Descripcion_Evento }}"
                                                    data-etapa="{{ $item->Estado }}"
                                                    style="background-color:red;">

                                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                                </button>
                                                <form action="{{ route('historial.destroy', $item->ID_Historial) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style="background-color:#1c1c1cff;" type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este historial?')">
                                                        <i class="fa-solid fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                            </table>

                             <!-- Paginación -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <!-- Botón Anterior -->
                        <li class="page-item {{ $datos->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link"
                               href="{{ $datos->previousPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}">
                                Atras
                            </a>
                        </li>

                        <!-- Números de página -->
                        @for ($i = 1; $i <= $datos->lastPage(); $i++)
                            <li class="page-item {{ $datos->currentPage() == $i ? 'active' : '' }}">
                                <a style="background-color:red;" class="page-link"
                                   href="{{ $datos->url($i) }}{{ request('search') ? '&search=' . request('search') : '' }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor

                        <!-- Botón Siguiente -->
                        <li class="page-item {{ !$datos->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link"
                               href="{{ $datos->nextPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}">
                                Siguiente
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Información de registros -->
                <div class="text-muted mt-2">
                    Mostrando {{ $datos->firstItem() }} a {{ $datos->lastItem() }} de {{ $datos->total() }} registros
                </div>

                @else
                <div class="alert alert-info text-center mt-3">
                    <i class="fas fa-info-circle"></i>
                    @if(request('search'))
                        No se encontraron historiales con ese tipo de dato "{{ request('search') }}"
                    @else
                        No hay historiales registrados.
                    @endif
                </div>
                @endif
            </div>
            <!--Modal Agregar -->

<div class="modal fade" id="AgregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user"></i> Crear Historial</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('historial.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="ID_Historial" class="form-label">Código del historial</label>
            <input type="number" class="form-control" id="ID_Historial" name="ID_Historial" placeholder="Digite el código" required>
          </div>
          <div class="mb-3">
            <label for="ID_Servicio" class="form-label">Código del servicio</label>
            <input type="number" class="form-control" id="ID_Servicio" name="ID_Servicio" placeholder="Digite el código del servicio" required>
          </div>
          <div class="mb-3">
            <label for="Fecha_Evento" class="form-label">Fecha del historial</label>
            <input type="date" class="form-control" id="Fecha_Evento" name="Fecha_Evento" required>
          </div>
          <div class="mb-3">
            <label for="Descripcion_Evento" class="form-label">Descripción</label>
            <textarea class="form-control" id="Descripcion_Evento" name="Descripcion_Evento" rows="3" placeholder="Digite la descripción" required></textarea>
          </div>
          <div class="mb-3">
            <label for="Estado" class="form-label">Estado</label>
            <select class="form-select" id="Estado" name="Estado" required>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background-color:red;"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

            <!--Modal Modificar-->
 <div class="modal fade" id="EditarModal" tabindex="-1" aria-labelledby="EditarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditarModalLabel"><i class="fa-solid fa-user-pen"></i> Editar Historial</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="editID_Historial" class="form-label">Código del historial</label>
            <input type="text" class="form-control" id="editID_Historial" name="ID_Historial" readonly>
          </div>
          <div class="mb-3">
            <label for="editID_Servicio" class="form-label">Código del servicio</label>
            <input type="number" class="form-control" id="editID_Servicio" name="ID_Servicio" required>
          </div>
          <div class="mb-3">
            <label for="editFecha_Evento" class="form-label">Fecha del historial</label>
            <input type="date" class="form-control" id="editFecha_Evento" name="Fecha_Evento" required>
          </div>
          <div class="mb-3">
            <label for="editDescripcion_Evento" class="form-label">Descripción</label>
            <textarea class="form-control" id="editDescripcion_Evento" name="Descripcion_Evento" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="editEtapa" class="form-label">Estado</label>
            <select class="form-select" id="editEtapa" name="Estado" required>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background-color:red;"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



        </div>
        
    </container>
</body>
</html>
<script>
var editarModal = document.getElementById('EditarModal');
editarModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;

    var id = button.getAttribute('data-id');
    var idServ = button.getAttribute('data-idServ');
    var fecha = button.getAttribute('data-fecha');
    var desc = button.getAttribute('data-desc');
    var estado = button.getAttribute('data-etapa');

    document.getElementById('editID_Historial').value = id;
    document.getElementById('editID_Servicio').value = idServ;
    document.getElementById('editFecha_Evento').value = fecha;
    document.getElementById('editDescripcion_Evento').value = desc;
    document.getElementById('editEtapa').value = estado;

    var form = document.getElementById('editForm');
    form.action = '/historial/' + id;
});

</script>


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