<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChecKAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Definir Rutas Públicas (sin autenticación)
        // Usamos is() con 'iniciosesion*' para cubrir la ruta base y rutas con query params si los hubiera.
        $publicRoutes = [
            'iniciosesion',
            'iniciosesion/*', // Permite 'iniciosesion' y cualquier sub-ruta
        ];
        
        // 2. Mapeo de Rutas Permitidas por Rol
        // Se añade '/*' a todas las rutas para permitir sub-rutas y parámetros (CRUD).
        // Se añade 'index' para asegurar acceso al dashboard si está definido como /index.
        $roleRoutesMap = [
            // El índice debe coincidir con el valor de Codigo_Rol (1, 2, 3, etc.)
            1 => [
                '/', // RUTA RAÍZ (Welcome page o base)
                'index', // RUTA DEL DASHBOARD si es '/index' <-- Añadido
                'servicio', 'servicio/*', 
                'adminservicio', 'adminservicio/*',
                'historial', 'historial/*',
            ],
            3 => [
                '/', // RUTA RAÍZ (Welcome page o base)
                'index', // RUTA DEL DASHBOARD si es '/index' <-- Añadido
                'usuario', 'usuario/*',
                'roles', 'roles/*',
                'tipo', 'tipo/*',
            ],
            2 => [
                '/', // RUTA RAÍZ (Welcome page o base)
                'index', // RUTA DEL DASHBOARD si es '/index' <-- Añadido
                'producto', 'producto/*',
                'categoria', 'categoria/*',
                'pregunta', 'pregunta/*',
                'comentarios', 'comentarios/*',
                'chat', 'chat/*',
                'protochat', 'protochat/*',
                'mensajes', 'mensajes/*',
                'notificaciones', 'notificaciones/*',
            ],
        ];

        // --- LÓGICA DE ACCESO ---
        
        // A. Si la ruta es pública, permitir el acceso.
        if ($request->is($publicRoutes)) {
            return $next($request);
        }
        
        // B. Si no hay usuario en la sesión, redirigir al login.
        if (!$request->session()->has('user')) {
            // Usamos route('iniciosesion') en lugar de ruta hardcodeada para mantener la flexibilidad
            return redirect()->route('iniciosesion')->with('error', 'Debes iniciar sesion para aceder a la página');
        }
        
        // C. El usuario está autenticado. Verificar el Codigo_Rol.
        
        // OBTENER EL CÓDIGO DEL ROL DESDE EL OBJETO DE SESIÓN
        $user = $request->session()->get('user');
        $userRoleCode = $user['Codigo_Rol'] ?? null; // Acceder como array, no como objeto.
        
        // 1. Verificar si el rol del usuario es conocido/válido (1, 2, o 3)
        if (isset($roleRoutesMap[$userRoleCode])) {
            
            // Obtener todas las rutas permitidas para el rol actual
            $allowedRoutes = $roleRoutesMap[$userRoleCode];
            
            // Comprobar si la RUTA ACTUAL coincide con las rutas permitidas para SU Codigo_Rol.
            // NOTA: is() verifica si la URL actual coincide con el patrón.
            if ($request->is($allowedRoutes)) {
                // El usuario tiene el Codigo_Rol correcto y está en una ruta permitida. PERMITIR ACCESO.
                return $next($request);
            }
            
            // Acceso denegado: El usuario tiene un rol, pero intenta acceder a una ruta de otro rol.
            // Redirigimos a la ruta de inicio permitida para SU rol (la primera de la lista, que es '/')
            $homeRoute = $allowedRoutes[0];
            return redirect($homeRoute)->with('error', 'No tienes permiso para acceder a esta página. Redirigido a tu panel de inicio.');

        }

        // 2. Si el Codigo_Rol no es 1, 2 o 3 (o no está mapeado), denegar acceso por seguridad.
        // En este caso, lo más seguro es redirigir al login y terminar la sesión de forma forzada.
        $request->session()->forget('user');
        return redirect()->route('iniciosesion')->with('error', 'Código de rol inválido o no configurado. Vuelve a iniciar sesión.');
    }
}
