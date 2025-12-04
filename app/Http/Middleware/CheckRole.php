<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/login');
        }
        
        // Verificar si el usuario tiene alguno de los roles permitidos
        if (!in_array($user->Codigo_Rol, $roles)) {
            // Redirigir al dashboard según su rol
            switch ($user->Codigo_Rol) {
                case 1: // Técnico
                    return redirect('/tecnico')->with('error', 'No tienes permiso para acceder a esta sección.');
                    
                case 2: // Cliente
                    return redirect('/cliente')->with('error', 'No tienes permiso para acceder a esta sección.');
                    
                case 3: // Administrador
                    return redirect('/admin')->with('error', 'No tienes permiso para acceder a esta sección.');
                    
                default:
                    return redirect('/dashboard')->with('error', 'No tienes permiso para acceder a esta sección.');
            }
        }
        
        return $next($request);
    }
}
