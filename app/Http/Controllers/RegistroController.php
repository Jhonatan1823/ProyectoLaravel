<?php

namespace App\Http\Controllers;

use App\Models\UsuarioModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function create()
    {
        return view('registro');
    }

    // Crear un usuario (solo cliente)
    public function store(Request $request)
    {
        $request->validate([
            'ID_Usuario' => 'required|unique:usuario,ID_Usuario',
            'Codigo_Documento' => 'required',
            'Nombre' => 'required',
            'Fecha_Nacimiento' => 'required',
            'Direccion' => 'required',
            'Telefono' => 'required|numeric',
            'Correo' => 'required|email|unique:usuario,Correo',
            'Contraseña' => 'required|max:200',
        ]);

        UsuarioModelo::create([
            'ID_Usuario' => $request->ID_Usuario,
            'Codigo_Documento' => $request->Codigo_Documento,
            'Nombre' => $request->Nombre,
            'Fecha_Nacimiento' => $request->Fecha_Nacimiento,
            'Direccion' => $request->Direccion,
            'Telefono' => $request->Telefono,
            'Correo' => $request->Correo,
            'Contraseña' => Hash::make($request->Contraseña),
            'Codigo_Rol' => 2
        ]);

        return redirect()->route('iniciosesion')->with('success', 'Cuenta creada exitosamente, ahora puedes iniciar sesión.');
    }
}

