<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo Chat</title>
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
        <a  href="{{ route('welcome') }}"><h1 class="navbar-brand" style="color: white;">Celuaccel</h1></a>
      </div>
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
                <h3>Modulo Chat</h3>
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

                <form name="chat" action="{{ url('/chat') }}" method="GET">
                    <div class="text-end mb-3">
                        <button type="button" style="background-color:red;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarModal"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" name="search" value="{{ request ('search') }}" placeholder="Buscar por codigo del chat" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-success edit-btn" style="background-color:red;"><i class="fas fa-search-plus"></i> Buscar</button>
                            <a href="{{ url('/chat') }}">
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
                                        <th scope="col">Codigo de la sala de chat</th>
                                        <th scope="col">Usuario en la sala</th>
                                        <th scope="col">Servicio de la sala</th>
                                        <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datos as $item)
                                        <tr>
                                            <td>{{$item->Codigo_Chat}}</td>
                                            <td>{{$item->ID_Usuario}}</td>
                                            <td>{{$item->ID_Servicio}}</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-success edit-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#EditarModal"
                                                    data-id="{{ $item->Codigo_Chat }}"
                                                    data-idUsu="{{ $item->ID_Usuario }}"
                                                    data-idServ="{{ $item->ID_Servicio }}"
                                                    style="background-color:red;">
                                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                                </button>
                                                <form action="{{ route('chat.destroy', $item->Codigo_Chat) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style="background-color:#1c1c1cff;" type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta sala de chat?')">
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
                        No se encontraron salas de chats con ese tipo de dato "{{ request('search') }}"
                    @else
                        No hay salas de chats registradas.
                    @endif
                </div>
                @endif
            </div>
            <!--Modal Agregar -->

            <div class="modal fade" id="AgregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user"></i> Crear chat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('chat.store') }}" name="chat" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="Codigo_Chat" class="form-label">Codigo</label>
                        <input type="text" class="form-control" id="Codigo_Chat" name="Codigo_Chat" placeholder="Digite el Codigo de la sala de chat" required>
                    </div>
                    <div class="mb-3">
                        <label for="ID_Usuario" class="form-label">Codigo del Usuario</label>
                        <input type="text" class="form-control" id="ID_Usuario" name="ID_Usuario" placeholder="Digite el Codigo del usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="ID_Servicio" class="form-label">Codigo del Servicio</label>
                        <input type="text" class="form-control" id="ID_Servicio" name="ID_Servicio" placeholder="Digite el codigo del servicio" required>
                    </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color:#1c1c1cff;"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                        <button type="Submit" style="background-color:red;" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
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
                        <h5 class="modal-title" id="EditarModalLabel"><i class="fa-solid fa-user-pen"></i> Editar chat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT') <!-- Muy importante -->
                             <div class="mb-3">
                                <label for="Codigo_Chat" class="form-label">Codigo</label>
                               <input type="text" class="form-control" id="editCodigo_Chat" name="Codigo_Chat"  readonly>
                    <div class="mb-3">
                        <label for="editID_Usuario" class="form-label">Codigo del Usuario</label>
                        <input type="text" class="form-control" id="editID_Usuario" name="ID_Usuario" placeholder="Digite el Codigo del Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="editID_Servicio" class="form-label">Codigo del Servicio</label>
                        <input type="text" class="form-control" id="editID_Servicio" name="ID_Servicio" placeholder="Digite el Codigo del Servicio" required>
                    </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color:#1c1c1cff;"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                                <button type="submit" style="background-color:red;" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
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

    var id = button.getAttribute('data-id'); // Documento del cliente
    var idUsu = button.getAttribute('data-idUsu');
    var idServ = button.getAttribute('data-idServ');

    // Llenar modal
    document.getElementById('editCodigo_Chat').value = id;
    document.getElementById('editID_Usuario').value = idUsu;
    document.getElementById('editID_Servicio').value = idServ;

    // Cambiar acción del formulario
    var form = document.getElementById('editForm');
    form.action = '/chat/' + id;
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
            <h5 class="text-white mb-3">Módulos</h5>
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

@if($rol == 1)
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


