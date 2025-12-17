<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioModelo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    // Mostrar formulario de edición del perfil
    public function edit(Request $request)
    {
        $sessionUser = $request->session()->get('user');

        if (!$sessionUser) {
            return redirect()->route('iniciosesion')->with('error', 'Debes iniciar sesión para editar tu perfil.');
        }

        $usuario = UsuarioModelo::findOrFail($sessionUser['id']);

        return view('perfil', compact('usuario'));
    }

    // Actualizar perfil (todos los datos menos el rol)
    public function update(Request $request)
    {
        $sessionUser = $request->session()->get('user');

        if (!$sessionUser) {
            return redirect()->route('iniciosesion')->with('error', 'Debes iniciar sesión para actualizar tu perfil.');
        }

        $usuario = UsuarioModelo::findOrFail($sessionUser['id']);

        $request->validate([
            'Codigo_Documento' => 'required|numeric',
            'Nombre' => 'required|string|max:255',
            'Fecha_Nacimiento' => 'required|date',
            'Direccion' => 'required|string|max:255',
            'Telefono' => 'required|numeric|digits_between:7,20',
            'Correo' => [
                'required',
                'email',
                Rule::unique('usuario', 'Correo')->ignore($usuario->ID_Usuario, 'ID_Usuario'),
            ],
            'Contraseña' => 'nullable|min:8|confirmed',
        ]);

        $usuario->Codigo_Documento = $request->Codigo_Documento;
        $usuario->Nombre = $request->Nombre;
        $usuario->Fecha_Nacimiento = $request->Fecha_Nacimiento;
        $usuario->Direccion = $request->Direccion;
        $usuario->Telefono = $request->Telefono;
        $usuario->Correo = $request->Correo;

        if ($request->filled('Contraseña')) {
            $usuario->Contraseña = Hash::make($request->Contraseña);
        }

        $usuario->save();

        // Actualizar sesión
        $request->session()->put('user', [
            'id' => $usuario->ID_Usuario,
            'Nombre' => $usuario->Nombre,
            'Codigo_Rol' => $usuario->Codigo_Rol,
            'Descripcion_Rol' => $usuario->roles->Descripcion_Rol ?? null
        ]);

        return redirect()->route('perfil.edit')->with('success', 'Tus datos han sido actualizados.');
    }
}