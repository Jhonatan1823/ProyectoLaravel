<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChecKAuth
{
   
    public function handle(Request $request, Closure $next): Response
    {
        // Ruta noprotegidas
        $publicRoutes = [
            'iniciosesion',
            'iniciosesion/*',
        ];
        //Ruts Peritdas pra usuarios autenticados
        if($request->is($publicRoutes)){
            return$next($request);
        }
        //si no hya usuario en la sesion redigirir al login 
        if (!$request->session()->has('user')){
            return redirect()->route('iniciosesion')->with('error','Debes iniciar sesion para aceder a la pagina');
        }
        return $next($request);
    }
}

