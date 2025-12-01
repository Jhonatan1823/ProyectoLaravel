<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioModelo;
use Illuminate\Support\Facades\Hash;

class AutenticarController extends Controller
{
    public function showLogin()
    {
        return view('iniciosesion');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'Codigo_Documento' => 'required|numeric',
            'ID_Usuario' => 'required|string',
            'Contraseña' => 'required|string',
        ]);
        /*BUSCAR USUARIO EN LA BASE DE DATOS*/
        $user = UsuarioModelo::where('ID_Usuario',$request->ID_Usuario)
                                ->where('Codigo_Documento',$request->Codigo_Documento)
                                ->first();
        if(!$user){
            return back()->withErrors(['ID_Usuario' => 'El Documento no existe.'])->withInput();
        }
        /*VERIFICAR CONTRASEÑA*/
        if(!Hash::check($request->Contraseña, $user->Contraseña)){
            return back()->withErrors(['Contraseña' => 'La contraseña es Incorrecta.'])->withInput();
        }
        /*REGENERAR LA SESION PARA EVITAR ATAQUES DE FIJACION DE SESION*/
        $request->session()->regenerate();

        /*ALMACENAR EL ID DEL USUARIO EN LA SESION*/
        $request->session()->put('user',[
            'id' => $user->ID_Usuario,
            'Nombre' => $user->Nombre,
            'Codigo_Rol' => $user->Codigo_Rol,
            'Descripcion_Rol' => $user->roles->Descripcion_Rol ?? null
        ]);

        return redirect()->intended('/');
    }

    /*CERRAR SESION*/
    public function logout (Request $request)
    {
        /* limpiar todos los datos de la sesion*/
        $request ->session()->forget('user');
        /* Invalidad la session actual*/
        $request ->session()->invalidate();
        $request ->session()->regenerateToken();
        return redirect()->route('iniciosesion')->with('success','Has cerrado sesion correctamente');
    }
}


