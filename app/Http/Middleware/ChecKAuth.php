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
        // Rutas Publicas
        $publicRoutes = [
            'iniciosesion',
            'iniciosesion/*',
        ];
        //Roles
        $roleRoutesMap = [
            1 => [
                '/',
                'index',
                'perfil', 'perfil/*',
                'servicio', 'servicio/*',
                'adminservicio', 'adminservicio/*',
                'historial', 'historial/*',
                'chat', 'chat/*',
                'protochat', 'protochat/*',
                'mensajes', 'mensajes/*',
                'notificaciones', 'notificaciones/*',

            ],
            3 => [
                '/',
                'index',
                'usuario', 'usuario/*',
                'perfil', 'perfil/*',
                'roles', 'roles/*',
                'tipo', 'tipo/*',
                'producto', 'producto/*',
                'categoria', 'categoria/*',
                'pregunta', 'pregunta/*',
                'comentarios', 'comentarios/*',
                'chat', 'chat/*',
                'protochat', 'protochat/*',
                'mensajes', 'mensajes/*',
                'notificaciones', 'notificaciones/*',
                'servicio', 'servicio/*',
                'adminservicio', 'adminservicio/*',
                'historial', 'historial/*',
            ],
            2 => [
                '/',
                'index',
                'perfil', 'perfil/*',
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
        
        // Ruta publica, permitir acceso
        if ($request->is($publicRoutes)) {
            return $next($request);
        }
        
        // Si no hay un usuario, redirige al inicio
        if (!$request->session()->has('user')) {
            return redirect()->route('iniciosesion')->with('error', 'Debes iniciar sesion para aceder a la página');
        }
        
        // Si hay un usuario usando un rol
        // Obtener el rol
        $user = $request->session()->get('user');
        $userRoleCode = $user['Codigo_Rol'] ?? null;
        
        // Revisar si existe el rol
        if (isset($roleRoutesMap[$userRoleCode])) {
            
            $allowedRoutes = $roleRoutesMap[$userRoleCode];
            
            // Verificar si el usuario esta permitido en la ruta
            if ($request->is($allowedRoutes)) {
                return $next($request);
            }
            
            // Si el rol no esta permitido redirije a inicio
            $homeRoute = $allowedRoutes[0];
            return redirect($homeRoute)->with('error', 'No tienes permiso para acceder a esta página. Redirigido a tu panel de inicio.');

        }

        // Si el rol no existe
        $request->session()->forget('user');
        return redirect()->route('iniciosesion')->with('error', 'Código de rol inválido o no configurado. Vuelve a iniciar sesión.');
    }
}
