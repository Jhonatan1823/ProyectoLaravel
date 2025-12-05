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

// ✅ Ruta temporal para hashear contraseñas (ELIMINAR EN PRODUCCIÓN)
Route::get('/hash-passwords', [AuthController::class, 'hashExistingPasswords'])->name('hash.passwords');

// ✅ VISTAS PÚBLICAS (usando vistas que SÍ tienes)
Route::get('/index', function(){ return view('publico'); })->name('index'); // Usa publico.blade.php
Route::get('/iniciosesion', function(){ return view('auth.login'); })->name('iniciosesion');
Route::get('/protochat', function(){ return view('chat'); })->name('protochat'); // Usa chat.blade.php
Route::get('/adminservicio', function(){ return view('servicio'); })->name('adminservicio'); // Usa servicio.blade.php

// ========================
// 🛡️ RUTAS PROTEGIDAS (Requieren autenticación)
// ========================

Route::middleware(['auth'])->group(function () {
    
    // ✅ LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // ✅ DASHBOARD GENERAL (redirige según rol)
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // ✅ RUTAS DE PERFIL GENERALES
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [AuthController::class, 'changePassword'])->name('profile.password');

    // ========================
    // 👤 RUTAS PARA CLIENTES (Rol 2) - USANDO VISTAS EXISTENTES
    // ========================
    Route::prefix('cliente')->name('cliente.')->group(function () {
        
        // 📱 Dashboard Cliente - USA LA VISTA QUE TIENES
        Route::get('/', function(){ 
            // Verifica cuál vista existe realmente
            if (view()->exists('cliente.clienteDashboard')) {
                return view('cliente.clienteDashboard');
            } else {
                return view('cliente.dashboard');
            }
        })->name('dashboard');
        
        // 📱 Servicios del Cliente - USA VISTA SERVICIO.BLADE.PHP EXISTENTE
        Route::get('/mis-servicios', function(){ 
            return view('servicio'); // Vista existente en raíz
        })->name('mis.servicios');
        
        Route::get('/servicios/nuevo', function(){ 
            return view('servicio'); // Misma vista para "nuevo"
        })->name('servicios.nuevo');
        
        // 💬 Chat del Cliente - USA VISTA CHAT.BLADE.PHP EXISTENTE
        Route::get('/mis-chats', function(){ 
            return view('chat'); // Vista existente en raíz
        })->name('mis.chats');
        
        // 🛒 Productos para Clientes - USA VISTA PRODUCTO.BLADE.PHP EXISTENTE
        Route::get('/catalogo', function(){ 
            return view('producto'); // Vista existente en raíz
        })->name('catalogo');
        
        // ❓ Preguntas - USA VISTA PREGUNTA.BLADE.PHP EXISTENTE
        Route::get('/mis-preguntas', function(){ 
            return view('pregunta'); // Vista existente en raíz
        })->name('mis.preguntas');
        
        // 💬 Mis Comentarios - USA VISTA COMENTARIOS.BLADE.PHP EXISTENTE
        Route::get('/mis-comentarios', function(){ 
            return view('comentarios'); // Vista existente en raíz
        })->name('mis.comentarios');
        
        // 👤 Perfil del Cliente
        Route::get('/perfil', [AuthController::class, 'profile'])->name('perfil');
        Route::post('/perfil/actualizar', [AuthController::class, 'updateProfile'])->name('perfil.actualizar');
        Route::post('/perfil/cambiar-password', [AuthController::class, 'changePassword'])->name('perfil.password');
    });

    // ========================
    // 🔧 RUTAS PARA TÉCNICOS (Rol 1) - USANDO VISTAS EXISTENTES
    // ========================
    Route::prefix('tecnico')->name('tecnico.')->group(function () {
        
        // 🔧 Dashboard Técnico - USA LA VISTA QUE TIENES
        Route::get('/', function(){ 
            return view('tecnico.dashboard'); // Vista existente
        })->name('dashboard');
        
        // 🔧 Servicios asignados - USA VISTA SERVICIO.BLADE.PHP
        Route::get('/servicios-asignados', function(){ 
            return view('servicio'); // Vista existente
        })->name('servicios.asignados');
        
        // 📊 Historial - USA VISTA HISTORIAL.BLADE.PHP
        Route::get('/mi-historial', function(){ 
            return view('historial'); // Vista existente
        })->name('mi.historial');
        
        // 💬 Chats - USA VISTA CHAT.BLADE.PHP
        Route::get('/chats-asignados', function(){ 
            return view('chat'); // Vista existente
        })->name('chats.asignados');
        
        // 👤 Perfil del Técnico
        Route::get('/perfil', [AuthController::class, 'profile'])->name('perfil');
        
        // 📈 Estadísticas - REDIRIGE A DASHBOARD POR AHORA
        Route::get('/estadisticas', function(){ 
            return redirect()->route('tecnico.dashboard');
        })->name('estadisticas');
    });

    // ========================
    // 👑 RUTAS PARA ADMINISTRADORES (Rol 3) - USANDO VISTAS EXISTENTES
    // ========================
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // 📊 Dashboard Administrativo - USA LA VISTA QUE TIENES
        Route::get('/', function(){ 
            return view('admin.dashboard'); // Vista existente
        })->name('dashboard');
        
        // 📊 Panel administrativo - USA MISMA VISTA DASHBOARD
        Route::get('/panel', function(){ 
            return view('admin.dashboard'); // Misma vista
        })->name('panel');
        
        // 📈 Reportes y estadísticas - REDIRIGEN POR AHORA
        Route::get('/reportes', function(){ 
            return redirect()->route('admin.dashboard');
        })->name('reportes');
        
        Route::get('/estadisticas', function(){ 
            return redirect()->route('admin.dashboard');
        })->name('estadisticas');
        
        // 👤 Perfil del Administrador
        Route::get('/perfil', [AuthController::class, 'profile'])->name('perfil');
        
        // ========================
        // 🛠️ MÓDULOS CRUD ADMINISTRATIVOS - USANDO VISTAS EXISTENTES EN RAÍZ
        // ========================
        
        // Módulo de Usuarios - USA VISTA USUARIO.BLADE.PHP EXISTENTE
        Route::get('/usuarios', function(){ 
            return view('usuario'); // Vista existente en raíz
        })->name('admin.usuarios.index');
        
        // Módulo de Categorías - USA VISTA CATEGORIA.BLADE.PHP EXISTENTE
        Route::get('/categorias', function(){ 
            return view('categoria'); // Vista existente en raíz
        })->name('admin.categorias.index');
        
        // Módulo de Productos - USA VISTA PRODUCTO.BLADE.PHP EXISTENTE
        Route::get('/productos', function(){ 
            return view('producto'); // Vista existente en raíz
        })->name('admin.productos.index');
        
        // Módulo de Roles - USA VISTA ROLES.BLADE.PHP EXISTENTE
        Route::get('/roles', function(){ 
            return view('roles'); // Vista existente en raíz
        })->name('admin.roles.index');
        
        // Módulo de Tipos de Documento - USA VISTA TIPO.BLADE.PHP EXISTENTE
        Route::get('/tipos-documento', function(){ 
            return view('tipo'); // Vista existente en raíz
        })->name('admin.tipos.index');
    });

    // ========================
    // 📁 RUTAS CRUD COMPARTIDAS - USANDO TUS VISTAS EXISTENTES
    // ========================

    // Módulo de Servicios - USA VISTA SERVICIO.BLADE.PHP
    Route::get('/servicios', function(){ 
        return view('servicio'); 
    })->name('servicios.index');

    // Módulo de Chat - USA VISTA CHAT.BLADE.PHP
    Route::get('/chats', function(){ 
        return view('chat'); 
    })->name('chats.index');

    // Módulo de Historial - USA VISTA HISTORIAL.BLADE.PHP
    Route::get('/historiales', function(){ 
        return view('historial'); 
    })->name('historiales.index');

    // Módulo de Comentarios - USA VISTA COMENTARIOS.BLADE.PHP
    Route::get('/comentarios', function(){ 
        return view('comentarios'); 
    })->name('comentarios.index');

    // Módulo de Notificaciones - USA VISTA NOTIFICACIONES.BLADE.PHP
    Route::get('/notificaciones', function(){ 
        return view('notificaciones'); 
    })->name('notificaciones.index');

    // Módulo de Preguntas - USA VISTA PREGUNTA.BLADE.PHP
    Route::get('/preguntas', function(){ 
        return view('pregunta'); 
    })->name('preguntas.index');

    // Módulo de Mensajes - USA VISTA MENSAJES.BLADE.PHP
    Route::get('/mensajes', function(){ 
        return view('mensajes'); 
    })->name('mensajes.index');

    // ========================
    // 🔄 RUTAS DE REDIRECCIÓN PARA CONTROLADORES CRUD (opcional)
    // ========================
    
    // Si quieres mantener compatibilidad con tus controladores CRUD existentes
    Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index');
    Route::get('/servicio', [ServicioController::class, 'index'])->name('servicio.index');
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
    Route::get('/comentarios-crud', [ComentarioController::class, 'index'])->name('comentarios.crud');
    Route::get('/notificaciones-crud', [NotificacionesController::class, 'index'])->name('notificaciones.crud');
    Route::get('/pregunta-crud', [PreguntaController::class, 'index'])->name('pregunta.crud');
    Route::get('/roles-crud', [RolesController::class, 'index'])->name('roles.crud');
    Route::get('/tipo-crud', [TipoController::class, 'index'])->name('tipo.crud');
    Route::get('/mensajes-crud', [MensajesController::class, 'index'])->name('mensajes.crud');

});

// ========================
// 🧪 RUTA DE DIAGNÓSTICO (TEMPORAL)
// ========================
Route::get('/test-vistas', function() {
    echo "<h1>✅ Vistas Existentes</h1>";
    
    $vistas = [
        'cliente.dashboard' => 'cliente/dashboard.blade.php',
        'cliente.clienteDashboard' => 'cliente/clienteDashboard.blade.php',
        'servicio' => 'servicio.blade.php',
        'producto' => 'producto.blade.php',
        'chat' => 'chat.blade.php',
        'usuario' => 'usuario.blade.php',
        'categoria' => 'categoria.blade.php',
        'tecnico.dashboard' => 'tecnico/dashboard.blade.php',
        'admin.dashboard' => 'admin/dashboard.blade.php',
        'auth.login' => 'auth/login.blade.php',
        'publico' => 'publico.blade.php',
    ];
    
    foreach ($vistas as $nombre => $archivo) {
        if (view()->exists($nombre)) {
            echo "✅ <strong>$nombre</strong> existe ($archivo)<br>";
        } else {
            echo "❌ <strong>$nombre</strong> NO existe<br>";
        }
    }
    
    echo "<h2>📁 Estructura de vistas:</h2>";
    echo "<pre>";
    $files = scandir(resource_path('views'));
    print_r($files);
    echo "</pre>";
});

