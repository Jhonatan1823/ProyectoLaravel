<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Categorías - Celuaccel</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CSS Personalizado -->
    <style>
        :root {
            --primary-color: #d20000;
            --primary-dark: #a00000;
            --secondary-color: #1c1c1c;
            --background-color: #ffffff;
            --text-color: #333333;
            --light-gray: #f5f5f5;
            --border-color: #e0e0e0;
        }
        
        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: var(--text-color);
        }
        
        .navbar-celuaccel {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .btn-celuaccel-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .btn-celuaccel-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }
        
        .btn-celuaccel-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }
        
        .btn-celuaccel-secondary:hover {
            background-color: #333;
            border-color: #333;
            color: white;
        }
        
        .card-celuaccel {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-top: 5px solid var(--primary-color);
            margin-bottom: 20px;
        }
        
        .card-header-celuaccel {
            background-color: white;
            border-bottom: 2px solid var(--light-gray);
            border-radius: 12px 12px 0 0 !important;
            padding: 20px;
        }
        
        .table-celuaccel {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        
        .table-celuaccel thead {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .table-celuaccel th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        
        .table-celuaccel tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-celuaccel tbody tr:hover {
            background-color: rgba(210, 0, 0, 0.05);
        }
        
        .table-celuaccel td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .alert-celuaccel {
            border-radius: 10px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        
        .alert-celuaccel-success {
            background-color: #e6ffe6;
            color: #008000;
            border-left: 4px solid #00cc00;
        }
        
        .alert-celuaccel-danger {
            background-color: #ffe6e6;
            color: var(--primary-color);
            border-left: 4px solid var(--primary-color);
        }
        
        .alert-celuaccel-info {
            background-color: #e6f7ff;
            color: #0066cc;
            border-left: 4px solid #0066cc;
        }
        
        .form-control-celuaccel {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control-celuaccel:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(210, 0, 0, 0.25);
        }
        
        .input-group-celuaccel .input-group-text {
            background-color: var(--light-gray);
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 8px 0 0 8px;
        }
        
        .pagination-celuaccel .page-link {
            color: var(--primary-color);
            border: 1px solid #e0e0e0;
            margin: 0 5px;
            border-radius: 8px;
        }
        
        .pagination-celuaccel .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .pagination-celuaccel .page-link:hover {
            background-color: rgba(210, 0, 0, 0.1);
            color: var(--primary-dark);
        }
        
        .modal-header-celuaccel {
            background-color: var(--secondary-color);
            color: white;
            border-radius: 12px 12px 0 0;
        }
        
        .modal-footer-celuaccel {
            border-top: 2px solid var(--light-gray);
            background-color: #f9f9f9;
            border-radius: 0 0 12px 12px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 10px;
                overflow: hidden;
            }
            
            .btn-group {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            
            .btn-group .btn {
                width: 100%;
                margin: 0 !important;
            }
        }
        
        .badge-celuaccel {
            background-color: var(--primary-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            z-index: 10;
        }
        
        .search-input {
            padding-left: 45px !important;
        }
        
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            text-align: center;
            border-top: 3px solid var(--primary-color);
        }
        
        .stats-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--secondary-color);
            line-height: 1;
        }
        
        .stats-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        /* Offcanvas menu */
        .offcanvas-start {
            background-color: var(--secondary-color);
            color: white;
            width: 280px !important;
        }
        
        .offcanvas-header-celuaccel {
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .offcanvas-title-celuaccel {
            color: white;
            font-weight: bold;
        }
        
        .offcanvas-body-celuaccel a {
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            display: block;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        
        .offcanvas-body-celuaccel a:hover {
            background-color: rgba(210, 0, 0, 0.2);
        }
        
        .offcanvas-body-celuaccel a i {
            width: 25px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-celuaccel sticky-top">
        <div class="container-fluid">
            <!-- Botón menú hamburguesa -->
            <button class="btn btn-celuaccel-secondary me-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Logo y título -->
            <a class="navbar-brand" href="#">
                <i class="fas fa-mobile-alt me-2"></i> Celuaccel
            </a>
            
            <!-- Indicador de módulo -->
            <div class="navbar-text d-none d-md-block text-white">
                <span class="badge-celuaccel">
                    <i class="fas fa-icons me-1"></i> Módulo Categorías
                </span>
            </div>
            
            <!-- Menú derecho -->
            <div class="d-flex align-items-center ms-auto">
                <!-- Notificaciones -->
                <div class="dropdown me-3">
                    <button class="btn btn-outline-light position-relative" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Notificaciones</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-tools text-primary me-2"></i> Nuevo servicio asignado</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-comment text-success me-2"></i> Nuevo mensaje</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Alerta del sistema</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="#"><i class="fas fa-list me-2"></i> Ver todas</a></li>
                    </ul>
                </div>
                
                <!-- Usuario -->
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::user()->Nombre ?? 'Usuario' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">{{ Auth::user()->Nombre ?? 'Usuario' }}</h6></li>
                        <li><a class="dropdown-item" href="/profile"><i class="fas fa-user-cog me-2"></i> Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="/dashboard"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none text-danger w-100 text-start">
                                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar Offcanvas -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" style="background-color: var(--secondary-color);">
                <div class="offcanvas-header offcanvas-header-celuaccel">
                    <h5 class="offcanvas-title offcanvas-title-celuaccel">
                        <i class="fas fa-bars me-2"></i> Menú Principal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body offcanvas-body-celuaccel">
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">MÓDULOS PRINCIPALES</h6>
                        <a href="{{ route('dashboard') }}" class="mb-2">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="{{ route('producto.index') }}" class="mb-2">
                            <i class="fas fa-box"></i> Productos
                        </a>
                        <a href="{{ route('categoria.index') }}" class="mb-2 active">
                            <i class="fas fa-icons"></i> Categorías
                        </a>
                        <a href="{{ route('servicio.index') }}" class="mb-2">
                            <i class="fas fa-tools"></i> Servicios
                        </a>
                        <a href="{{ route('usuario.index') }}" class="mb-2">
                            <i class="fas fa-users"></i> Usuarios
                        </a>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">COMUNICACIÓN</h6>
                        <a href="{{ route('chat.index') }}" class="mb-2">
                            <i class="fas fa-comments"></i> Chat
                        </a>
                        <a href="{{ route('mensajes.index') }}" class="mb-2">
                            <i class="fas fa-envelope"></i> Mensajes
                        </a>
                    </div>
                    
                    <div>
                        <h6 class="text-muted mb-3">OTROS MÓDULOS</h6>
                        <a href="{{ route('historial.index') }}" class="mb-2">
                            <i class="fas fa-history"></i> Historial
                        </a>
                        <a href="{{ route('comentarios.index') }}" class="mb-2">
                            <i class="fas fa-comment-dots"></i> Comentarios
                        </a>
                        <a href="{{ route('notificaciones.index') }}" class="mb-2">
                            <i class="fas fa-bell"></i> Notificaciones
                        </a>
                    </div>
                    
                    <hr class="text-white-50 my-4">
                    
                    <div class="text-center">
                        <small class="text-white-50">Sistema Celuaccel v1.0</small>
                    </div>
                </div>
            </div>

            <!-- Contenido principal -->
            <main class="col-12">
                <!-- Tarjetas de estadísticas -->
                <div class="row mb-4">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stats-card">
                            <div class="stats-value">{{ $datos->total() ?? 0 }}</div>
                            <div class="stats-label">Total Categorías</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stats-card">
                            <div class="stats-value">{{ $datos->count() ?? 0 }}</div>
                            <div class="stats-label">Mostrando</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stats-card">
                            <div class="stats-value">{{ $datos->currentPage() ?? 1 }}</div>
                            <div class="stats-label">Página Actual</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stats-card">
                            <div class="stats-value">{{ $datos->lastPage() ?? 1 }}</div>
                            <div class="stats-label">Total Páginas</div>
                        </div>
                    </div>
                </div>

                <!-- Card principal -->
                <div class="card card-celuaccel">
                    <div class="card-header card-header-celuaccel">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">
                                    <i class="fas fa-icons text-primary me-2"></i> Gestión de Categorías
                                </h4>
                                <p class="text-muted mb-0 mt-1">Administra las categorías de productos del sistema</p>
                            </div>
                            <button type="button" class="btn btn-celuaccel-primary" data-bs-toggle="modal" data-bs-target="#AgregarModal">
                                <i class="fas fa-plus me-2"></i> Nueva Categoría
                            </button>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Alertas -->
                        @if (session('success'))
                            <div class="alert alert-celuaccel alert-celuaccel-success alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-celuaccel alert-celuaccel-danger alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-celuaccel alert-celuaccel-danger alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-times-circle me-2"></i> <strong>Errores encontrados:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Formulario de búsqueda -->
                        <form name="categoria" action="{{ url('/categoria') }}" method="GET" class="mb-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-8">
                                    <div class="search-box">
                                        <i class="fas fa-search search-icon"></i>
                                        <input type="text" class="form-control form-control-celuaccel search-input" 
                                               name="search" value="{{ request('search') }}" 
                                               placeholder="Buscar por código o nombre de categoría...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-celuaccel-primary flex-fill">
                                            <i class="fas fa-search me-2"></i> Buscar
                                        </button>
                                        <a href="{{ url('/categoria') }}" class="btn btn-celuaccel-secondary flex-fill">
                                            <i class="fas fa-sync-alt me-2"></i> Resetear
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Tabla de categorías -->
                        @if($datos->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-celuaccel">
                                    <thead>
                                        <tr>
                                            <th width="30%">
                                                <i class="fas fa-hashtag me-2"></i> Código
                                            </th>
                                            <th width="50%">
                                                <i class="fas fa-tag me-2"></i> Nombre de Categoría
                                            </th>
                                            <th width="20%" class="text-center">
                                                <i class="fas fa-cogs me-2"></i> Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datos as $item)
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                                    <strong>{{ $item->ID_Categoria }}</strong>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-folder"></i>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $item->Nombre_Categoria }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                                            data-bs-toggle="modal" data-bs-target="#EditarModal"
                                                            data-id="{{ $item->ID_Categoria }}" 
                                                            data-nomb="{{ $item->Nombre_Categoria }}">
                                                        <i class="fas fa-edit"></i>
                                                        <span class="d-none d-md-inline"> Editar</span>
                                                    </button>
                                                    <form action="{{ route('categoria.destroy', $item->ID_Categoria) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                onclick="return confirm('¿Estás seguro de eliminar la categoría: {{ $item->Nombre_Categoria }}?')">
                                                            <i class="fas fa-trash"></i>
                                                            <span class="d-none d-md-inline"> Eliminar</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted">
                                    Mostrando <strong>{{ $datos->firstItem() ?? 0 }}</strong> a 
                                    <strong>{{ $datos->lastItem() ?? 0 }}</strong> de 
                                    <strong>{{ $datos->total() ?? 0 }}</strong> registros
                                </div>
                                
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-celuaccel">
                                        <!-- Botón Anterior -->
                                        <li class="page-item {{ $datos->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" 
                                               href="{{ $datos->previousPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>

                                        <!-- Números de página -->
                                        @php
                                            $start = max(1, $datos->currentPage() - 2);
                                            $end = min($datos->lastPage(), $datos->currentPage() + 2);
                                        @endphp
                                        
                                        @if($start > 1)
                                            <li class="page-item"><a class="page-link" href="{{ $datos->url(1) }}{{ request('search') ? '&search=' . request('search') : '' }}">1</a></li>
                                            @if($start > 2)<li class="page-item disabled"><span class="page-link">...</span></li>@endif
                                        @endif
                                        
                                        @for ($i = $start; $i <= $end; $i++)
                                            <li class="page-item {{ $datos->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" 
                                                   href="{{ $datos->url($i) }}{{ request('search') ? '&search=' . request('search') : '' }}">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endfor
                                        
                                        @if($end < $datos->lastPage())
                                            @if($end < $datos->lastPage() - 1)<li class="page-item disabled"><span class="page-link">...</span></li>@endif
                                            <li class="page-item"><a class="page-link" href="{{ $datos->url($datos->lastPage()) }}{{ request('search') ? '&search=' . request('search') : '' }}">{{ $datos->lastPage() }}</a></li>
                                        @endif

                                        <!-- Botón Siguiente -->
                                        <li class="page-item {{ !$datos->hasMorePages() ? 'disabled' : '' }}">
                                            <a class="page-link" 
                                               href="{{ $datos->nextPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-folder-open fa-4x text-muted"></i>
                                </div>
                                <h4 class="text-muted mb-3">
                                    @if(request('search'))
                                        No se encontraron categorías con "{{ request('search') }}"
                                    @else
                                        No hay categorías registradas
                                    @endif
                                </h4>
                                <p class="text-muted mb-4">Comienza agregando una nueva categoría</p>
                                <button type="button" class="btn btn-celuaccel-primary" data-bs-toggle="modal" data-bs-target="#AgregarModal">
                                    <i class="fas fa-plus me-2"></i> Agregar Primera Categoría
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="AgregarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-celuaccel">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i> Crear Nueva Categoría
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('categoria.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="ID_Categoria" class="form-label fw-bold">
                                    <i class="fas fa-hashtag me-2"></i> Código de Categoría
                                </label>
                                <input type="number" class="form-control form-control-celuaccel" 
                                       id="ID_Categoria" name="ID_Categoria" 
                                       placeholder="Ej: 1001" required>
                                <div class="form-text">Ingresa un código numérico único</div>
                            </div>
                            <div class="col-md-6">
                                <label for="Nombre_Categoria" class="form-label fw-bold">
                                    <i class="fas fa-tag me-2"></i> Nombre de Categoría
                                </label>
                                <input type="text" class="form-control form-control-celuaccel" 
                                       id="Nombre_Categoria" name="Nombre_Categoria" 
                                       placeholder="Ej: Accesorios, Reparaciones, etc." required>
                                <div class="form-text">Nombre descriptivo de la categoría</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-celuaccel">
                        <button type="button" class="btn btn-celuaccel-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-celuaccel-primary">
                            <i class="fas fa-save me-2"></i> Guardar Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="EditarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-celuaccel">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i> Editar Categoría
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="editID_Categoria" class="form-label fw-bold">
                                    <i class="fas fa-hashtag me-2"></i> Código de Categoría
                                </label>
                                <input type="text" class="form-control form-control-celuaccel" 
                                       id="editID_Categoria" name="ID_Categoria" readonly>
                                <div class="form-text">Código único (no editable)</div>
                            </div>
                            <div class="col-md-6">
                                <label for="editNombre_Categoria" class="form-label fw-bold">
                                    <i class="fas fa-tag me-2"></i> Nombre de Categoría
                                </label>
                                <input type="text" class="form-control form-control-celuaccel" 
                                       id="editNombre_Categoria" name="Nombre_Categoria" 
                                       placeholder="Nuevo nombre de categoría" required>
                                <div class="form-text">Actualiza el nombre de la categoría</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-celuaccel">
                        <button type="button" class="btn btn-celuaccel-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-celuaccel-primary">
                            <i class="fas fa-save me-2"></i> Actualizar Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script para el modal de edición
            var editarModal = document.getElementById('EditarModal');
            editarModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var nomb = button.getAttribute('data-nomb');

                // Llenar modal
                document.getElementById('editID_Categoria').value = id;
                document.getElementById('editNombre_Categoria').value = nomb;

                // Actualizar acción del formulario
                var form = document.getElementById('editForm');
                form.action = '/categoria/' + id;
            });

            // Auto-focus en el campo de búsqueda
            var searchInput = document.querySelector('input[name="search"]');
            if (searchInput && !searchInput.value) {
                setTimeout(function() {
                    searchInput.focus();
                }, 300);
            }

            // Confirmación antes de eliminar (adicional)
            var deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    if (!confirm('¿Estás seguro de eliminar esta categoría? Esta acción no se puede deshacer.')) {
                        e.preventDefault();
                    }
                });
            });

            // Animación para las tarjetas de estadísticas
            var statsCards = document.querySelectorAll('.stats-card');
            statsCards.forEach(function(card, index) {
                setTimeout(function() {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.5s ease';
                    
                    setTimeout(function() {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });
        });
    </script>
</body>
</html>
