<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\AuthController;

// ========================
// 🌐 RUTAS PÚBLICAS
// ========================

Route::get('/', function () {
    return view('welcome');
});

// ✅ RUTAS DE AUTENTICACIÓN (Públicas)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// ✅ VISTAS PÚBLICAS
Route::get('/index', function(){ return view('index'); })->name('index');
Route::get('/iniciosesion', function(){ return view('iniciosesion'); })->name('iniciosesion');
Route::get('/protochat', function(){ return view('protochat'); })->name('protochat');
Route::get('/adminservicio', function(){ return view('adminservicio'); })->name('adminservicio');

// ========================
// 🛡️ RUTAS PROTEGIDAS (Requieren autenticación)
// ========================

Route::middleware(['auth'])->group(function () {
    
    // ✅ LOGOUT (solo para usuarios autenticados)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // ✅ DASHBOARDS GENERALES
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // ✅ DASHBOARDS POR ROL (mantengo tus rutas originales)
    Route::get('/cliente', function(){ return view('cliente.dashboard'); })->name('cliente.dashboard');
    Route::get('/tecnico', function(){ return view('tecnico.dashboard'); })->name('tecnico.dashboard');
    Route::get('/admin', function(){ return view('admin.dashboard'); })->name('admin.dashboard');

    // ========================
    // 👤 RUTAS PARA CLIENTES (Rol 2) - NUEVO GRUPO
    // ========================
    Route::prefix('cliente')->name('cliente.')->middleware(['auth'])->group(function () {
        
        // 📱 Servicios del Cliente
        Route::get('/mis-servicios', [ServicioController::class, 'misServicios'])->name('mis.servicios');
        Route::get('/servicios/nuevo', [ServicioController::class, 'create'])->name('servicios.nuevo');
        Route::get('/servicios/{id}/detalle', [ServicioController::class, 'showCliente'])->name('servicios.detalle');
        
        // 💬 Chat del Cliente
        Route::get('/mis-chats', [ChatController::class, 'misChats'])->name('mis.chats');
        Route::get('/chat/{servicio_id}', [ChatController::class, 'chatServicio'])->name('chat.servicio');
        Route::post('/chat/{servicio_id}/mensaje', [MensajesController::class, 'enviarMensajeCliente'])->name('chat.mensaje');
        
        // 🛒 Productos para Clientes (vista catalogo)
        Route::get('/catalogo', [ProductoController::class, 'catalogoCliente'])->name('catalogo');
        Route::get('/producto/{id}/detalle', [ProductoController::class, 'showCliente'])->name('producto.detalle');
        
        // ❓ Preguntas sobre productos
        Route::get('/mis-preguntas', [PreguntaController::class, 'misPreguntas'])->name('mis.preguntas');
        Route::post('/producto/{id}/preguntar', [PreguntaController::class, 'preguntarProducto'])->name('producto.preguntar');
        
        // 💬 Mis Comentarios
        Route::get('/mis-comentarios', [ComentarioController::class, 'misComentarios'])->name('mis.comentarios');
        
        // 👤 Perfil del Cliente
        Route::get('/perfil', [AuthController::class, 'profile'])->name('perfil');
        Route::post('/perfil/actualizar', [AuthController::class, 'updateProfile'])->name('perfil.actualizar');
        Route::post('/perfil/cambiar-password', [AuthController::class, 'changePassword'])->name('perfil.password');
    });

    // ========================
    // 🔧 RUTAS PARA TÉCNICOS (Rol 1) - NUEVO GRUPO
    // ========================
    Route::prefix('tecnico')->name('tecnico.')->middleware(['auth'])->group(function () {
        
        // 🔧 Servicios asignados al técnico
        Route::get('/servicios-asignados', [ServicioController::class, 'serviciosAsignados'])->name('servicios.asignados');
        Route::get('/servicio/{id}/gestionar', [ServicioController::class, 'gestionarServicio'])->name('servicio.gestionar');
        Route::put('/servicio/{id}/actualizar-estado', [ServicioController::class, 'actualizarEstado'])->name('servicio.estado');
        
        // 📊 Historial del Técnico
        Route::get('/mi-historial', [HistorialController::class, 'historialTecnico'])->name('mi.historial');
        Route::post('/servicio/{id}/registrar-historial', [HistorialController::class, 'registrarEvento'])->name('servicio.historial');
        
        // 💬 Chats asignados
        Route::get('/chats-asignados', [ChatController::class, 'chatsAsignados'])->name('chats.asignados');
        Route::get('/chat/{servicio_id}/atender', [ChatController::class, 'atenderChat'])->name('chat.atender');
        Route::post('/chat/{servicio_id}/responder', [MensajesController::class, 'responderMensaje'])->name('chat.responder');
        
        // 👤 Perfil del Técnico
        Route::get('/perfil', [AuthController::class, 'profile'])->name('perfil');
        
        // 📈 Estadísticas
        Route::get('/estadisticas', function(){ return view('tecnico.estadisticas'); })->name('estadisticas');
    });

    // ========================
    // 👑 RUTAS PARA ADMINISTRADORES (Rol 3) - NUEVO GRUPO
    // ========================
    Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
        
        // 📊 Dashboard administrativo
        Route::get('/panel', function(){ return view('admin.panel'); })->name('panel');
        
        // 📈 Reportes y estadísticas
        Route::get('/reportes', function(){ return view('admin.reportes'); })->name('reportes');
        Route::get('/estadisticas', function(){ return view('admin.estadisticas'); })->name('estadisticas');
        
        // 👤 Perfil del Administrador
        Route::get('/perfil', [AuthController::class, 'profile'])->name('perfil');
    });

    // ========================
    // 📁 TUS RUTAS CRUD ORIGINALES (SE MANTIENEN)
    // ========================

    // Módulo de Usuarios (accesible según permisos)
    Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index');
    Route::post('/usuario', [UsuarioController::class, 'store'])->name('usuario.store');
    Route::get('/usuario/{documento}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::put('/usuario/{documento}', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

    // Módulo de Servicios
    Route::get('/servicio', [ServicioController::class, 'index'])->name('servicio.index');
    Route::post('/servicio', [ServicioController::class, 'store'])->name('servicio.store');
    Route::get('/servicio/{documento}/edit', [ServicioController::class, 'edit'])->name('servicio.edit');
    Route::put('/servicio/{documento}', [ServicioController::class, 'update'])->name('servicio.update');
    Route::delete('/servicio/{id}', [ServicioController::class, 'destroy'])->name('servicio.destroy');

    // Módulo de Categorías
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::get('/categoria/{documento}/edit', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::put('/categoria/{documento}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');

    // Módulo de Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/{documento}/edit', [ChatController::class, 'edit'])->name('chat.edit');
    Route::put('/chat/{documento}', [ChatController::class, 'update'])->name('chat.update');
    Route::delete('/chat/{id}', [ChatController::class, 'destroy'])->name('chat.destroy');

    // Módulo de Historial
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
    Route::post('/historial', [HistorialController::class, 'store'])->name('historial.store');
    Route::get('/historial/{documento}/edit', [HistorialController::class, 'edit'])->name('historial.edit');
    Route::put('/historial/{documento}', [HistorialController::class, 'update'])->name('historial.update');
    Route::delete('/historial/{id}', [HistorialController::class, 'destroy'])->name('historial.destroy');

    // Módulo de Productos
    Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
    Route::post('/producto', [ProductoController::class, 'store'])->name('producto.store');
    Route::get('/producto/{documento}/edit', [ProductoController::class, 'edit'])->name('producto.edit');
    Route::put('/producto/{documento}', [ProductoController::class, 'update'])->name('producto.update');
    Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

    // Módulo de Comentarios
    Route::get('/comentarios', [ComentarioController::class, 'index'])->name('comentarios.index');
    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::get('/comentarios/{documento}/edit', [ComentarioController::class, 'edit'])->name('comentarios.edit');
    Route::put('/comentarios/{documento}', [ComentarioController::class, 'update'])->name('comentarios.update');
    Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');

    // Módulo de Notificaciones
    Route::get('/notificaciones', [NotificacionesController::class, 'index'])->name('notificaciones.index');
    Route::post('/notificaciones', [NotificacionesController::class, 'store'])->name('notificaciones.store');
    Route::get('/notificaciones/{documento}/edit', [NotificacionesController::class, 'edit'])->name('notificaciones.edit');
    Route::put('/notificaciones/{documento}', [NotificacionesController::class, 'update'])->name('notificaciones.update');
    Route::delete('/notificaciones/{id}', [NotificacionesController::class, 'destroy'])->name('notificaciones.destroy');

    // Módulo de Preguntas
    Route::get('/pregunta', [PreguntaController::class, 'index'])->name('pregunta.index');
    Route::post('/pregunta', [PreguntaController::class, 'store'])->name('pregunta.store');
    Route::get('/pregunta/{documento}/edit', [PreguntaController::class, 'edit'])->name('pregunta.edit');
    Route::put('/pregunta/{documento}', [PreguntaController::class, 'update'])->name('pregunta.update');
    Route::delete('/pregunta/{id}', [PreguntaController::class, 'destroy'])->name('pregunta.destroy');

    // Módulo de Roles
    Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RolesController::class, 'store'])->name('roles.store');
    Route::get('/roles/{documento}/edit', [RolesController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{documento}', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RolesController::class, 'destroy'])->name('roles.destroy');

    // Módulo de Tipos de Documento
    Route::get('/tipo', [TipoController::class, 'index'])->name('tipo.index');
    Route::post('/tipo', [TipoController::class, 'store'])->name('tipo.store');
    Route::get('/tipo/{documento}/edit', [TipoController::class, 'edit'])->name('tipo.edit');
    Route::put('/tipo/{documento}', [TipoController::class, 'update'])->name('tipo.update');
    Route::delete('/tipo/{id}', [TipoController::class, 'destroy'])->name('tipo.destroy');

    // Módulo de Mensajes
    Route::get('/mensajes', [MensajesController::class, 'index'])->name('mensajes.index');
    Route::post('/mensajes', [MensajesController::class, 'store'])->name('mensajes.store');
    Route::get('/mensajes/{documento}/edit', [MensajesController::class, 'edit'])->name('mensajes.edit');
    Route::put('/mensajes/{documento}', [MensajesController::class, 'update'])->name('mensajes.update');
    Route::delete('/mensajes/{id}', [MensajesController::class, 'destroy'])->name('mensajes.destroy');

});

// ========================
// 🔄 RUTAS DE FALLBACK
// ========================

Route::fallback(function () {
    return redirect('/login');
});

// ========================
// ❌ ELIMINAR RUTAS DUPLICADAS
// ========================

// ❌ COMENTA O ELIMINA ESTAS SECCIONES DUPLICADAS:
/*
// Rutas de Recurso para los módulos principales
// Módulo de Catálogo
Route::resource('producto', ProductoController::class);
Route::resource('categoria', CategoriaController::class);

// Módulo de Interacción  
Route::resource('pregunta', PreguntaController::class);

// Módulo de Servicios
Route::resource('servicio', ServicioController::class);
Route::resource('historial', HistorialController::class);

// Módulo de Comunicación
Route::resource('chat', ChatController::class);
Route::resource('mensajes', MensajesController::class);
Route::resource('notificaciones', NotificacionesController::class);

// Módulo de Gestión de Base
Route::resource('usuario', UsuarioController::class);
Route::resource('roles', RolesController::class);
Route::resource('documento', TipoController::class)->names('documento');
*/
