<?php

namespace App\Http\Controllers;
use App\Models\ProductoModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    //Buscar y Paginar
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = DB::table('producto');

        if($search){
            $query->where(function($q) use ($search){
                $q->where('Codigo_Producto', 'LIKE', "%{$search}%")
                ->orwhere('Nombre', 'LIKE', "%{$search}%")
                ->orwhere('Descripcion','LIKE',"%{$search}%");
            });
        }
        
        // Obtener el rol del usuario de la sesión
        $usersesion = $request->session()->get('user');
        $userRole = $usersesion['Codigo_Rol'] ?? null;
        
        $datos = $query->paginate(10);
        
        return view("producto")
            ->with("datos", $datos)
            ->with('userRole', $userRole);
    }

    //Insertar Datos
    public function store(Request $request){
        // Verificar que solo admin (rol 3) puedan crear
        $usersesion = $request->session()->get('user');
        $userRole = $usersesion['Codigo_Rol'] ?? null;
        
        if($userRole = 1 || $userRole = 2){
            return redirect()->route('producto.index')
                ->with('error', 'No tienes permisos para crear productos');
        }
        
        $request->validate([
            'Codigo_Producto' => 'required|unique:producto,Codigo_Producto',
            'Cantidad' => 'required|numeric',
            'Nombre' => 'required',
            'Precio' => 'required|numeric',
            'Descripcion' => 'required',
            'Imagen' => 'required',
            'Activo_Catalogo' => 'required',
            'ID_Categoria' => 'required'
        ],[
            'Codigo_Producto.unique' => 'El Producto con esta descripción ya existe en la plataforma.',
        ]);

        ProductoModelo::create($request->all());
        return redirect()->route('producto.index')
            ->with('success','Producto Registrado en la Plataforma');
    }

    //Update
    public function update(Request $request, $Codigo_Producto){
        // Verificar que solo admin (rol 3) pueda editar
        $usersesion = $request->session()->get('user');
        $userRole = $usersesion['Codigo_Rol'] ?? null;
        
        if($userRole = 2 || $userRole = 1){
            return redirect()->route('producto.index')
                ->with('error', 'No tienes permisos para editar productos');
        }
        
        $request->validate([
            'Cantidad' => 'required|numeric',
            'Nombre' => 'required',
            'Precio' => 'required|numeric',
            'Descripcion' => 'required',
            'Imagen' => 'required',
            'Activo_Catalogo' => 'required',
            'ID_Categoria' => 'required'
        ]);
        
        $producto = ProductoModelo::findOrFail($Codigo_Producto);
        $producto->update([
            'Cantidad' => $request->Cantidad,
            'Nombre' => $request->Nombre,
            'Descripcion' => $request->Descripcion,
            'Imagen' => $request->Imagen,
            'Precio' => $request->Precio,
            'Activo_Catalogo' => $request->Activo_Catalogo,
            'ID_Categoria' => $request->ID_Categoria,
        ]);
        
        return redirect()->route('producto.index')
            ->with('success','Producto Actualizado en la Plataforma');
    }
    
    // Eliminar
    public function destroy(Request $request, $id)
    {
        // Verificar que solo admin (rol 3) pueda eliminar
        $usersesion = $request->session()->get('user');
        $userRole = $usersesion['Codigo_Rol'] ?? null;
        
        if($userRole = 2 || $userRole = 1){
            return redirect()->route('producto.index')
                ->with('error', 'No tienes permisos para eliminar productos');
        }
        
        $producto = ProductoModelo::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}

