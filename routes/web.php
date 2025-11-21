<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\NotificacionesController;



use App\Models\ProductoModelo;
use App\Models\UsuarioModelo;
use App\Models\ServicioModelo;
use App\Models\HistorialModelo;
use App\Models\CategoriaModelo;
use App\Models\ChatModelo;
use App\Models\Notificaciones;
use App\Models\ComentariosModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuario',[UsuarioController::class,"index"])->name("usuario.index");
Route::post('/usuario',[UsuarioController::class,"store"])->name("usuario.store");
Route::get('/usuario/{documento}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::put('/usuario/{documento}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

Route::get('/producto',[ProductoController::class,"index"])->name("producto.index");
Route::post('/producto',[ProductoController::class,"store"])->name("producto.store");
Route::get('/producto/{documento}/edit', [ProductoController::class, 'edit'])->name('producto.edit');
Route::put('/producto/{documento}', [ProductoController::class, 'update'])->name('producto.update');
Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

Route::get('/comentarios',[ComentariosController::class,"index"])->name("comentarios.index");
Route::post('/comentarios',[ComentariosController::class,"store"])->name("comentarios.store");
Route::get('/comentarios/{documento}/edit', [ComentariosController::class, 'edit'])->name('comentarios.edit');
Route::put('/comentarios/{documento}', [ComentariosController::class, 'update'])->name('comentarios.update');
Route::delete('/comentarios/{id}', [ComentariosController::class, 'destroy'])->name('comentarios.destroy');

Route::get('/notificaciones',[NotificacionesController::class,"index"])->name("notificaciones.index");
Route::post('/notificaciones',[NotificacionesController::class,"store"])->name("notificaciones.store");
Route::get('/notificaciones/{documento}/edit', [NotificacionesController::class, 'edit'])->name('notificaciones.edit');
Route::put('/notificaciones/{documento}', [NotificacionesController::class, 'update'])->name('notificaciones.update');
Route::delete('/notificaciones/{id}', [NotificacionesController::class, 'destroy'])->name('notificaciones.destroy');

Route::get('/historial',[HistorialController::class,"index"])->name("historial.index");
Route::post('/historial',[HistorialController::class,"store"])->name("historial.store");
Route::get('/historial/{documento}/edit', [HistorialController::class, 'edit'])->name('historial.edit');
Route::put('/historial/{documento}', [HistorialController::class, 'update'])->name('historial.update');
Route::delete('/historial/{id}', [HistorialController::class, 'destroy'])->name('historial.destroy');

Route::get('/servicio',[ServicioController::class,"index"])->name("servicio.index");
Route::post('/servicio',[ServicioController::class,"store"])->name("servicio.store");
Route::get('/servicio/{documento}/edit', [ServicioController::class, 'edit'])->name('servicio.edit');
Route::put('/servicio/{documento}', [ServicioController::class, 'update'])->name('servicio.update');
Route::delete('/servicio/{id}', [ServicioController::class, 'destroy'])->name('servicio.destroy');

Route::get('/chat',[ChatController::class,"index"])->name("chat.index");
Route::post('/chat',[ChatController::class,"store"])->name("chat.store");
Route::get('/chat/{documento}/edit', [ChatController::class, 'edit'])->name('chat.edit');
Route::put('/chat/{documento}', [ChatController::class, 'update'])->name('chat.update');
Route::delete('/chat/{id}', [ChatController::class, 'destroy'])->name('chat.destroy');

Route::get('/categoria',[CategoriaController::class,"index"])->name("categoria.index");
Route::post('/categoria',[CategoriaController::class,"store"])->name("categoria.store");
Route::get('/categoria/{documento}/edit', [CategoriaController::class, 'edit'])->name('categoria.edit');
Route::put('/categoria/{documento}', [CategoriaController::class, 'update'])->name('categoria.update');
Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');


Route::get('/Servicio',[ServicioController::class,"index"])->name("servicio");
Route::get('/Chat',[ChatController::class,"index"])->name("chat");
