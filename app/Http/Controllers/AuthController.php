<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login
     */
    public function showLoginForm()
    {
        // Si ya está autenticado, redirigir al dashboard
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->Codigo_Rol);
        }
        
        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

       
        $user = User::where('Correo', $request->email)
                    ->orWhere('ID_Usuario', $request->email)
                    ->first();

        
        if ($user) {
            // Verificar la contraseña con Hash::check()
            if (Hash::check($request->password, $user->Contraseña)) {
         
                Auth::login($user, $request->remember ?? false);
                
           
                $request->session()->regenerate();
                
           
                return $this->redirectByRole($user->Codigo_Rol);
            }
        }

        
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Redirigir según el rol del usuario
     */
    private function redirectByRole($rol)
    {
        $message = '¡Bienvenido!';

        switch ($rol) {
            case 1: // Técnico
                return redirect()->route('tecnico.dashboard')->with('success', '¡Bienvenido Técnico!');
                
            case 2: // Cliente
                return redirect()->route('cliente.dashboard')->with('success', '¡Bienvenido Cliente!');
                
            case 3: // Administrador
                return redirect()->route('admin.dashboard')->with('success', '¡Bienvenido Administrador!');
                
            default:
                return redirect('/dashboard')->with('success', $message);
        }
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
 
        Auth::logout();
        
       
        $request->session()->invalidate();
        
      
        $request->session()->regenerateToken();
        
       
        return redirect('/login')->with('success', 'Sesión cerrada correctamente.');
    }

    /**
     * Dashboard principal
     */
    public function dashboard()
    {
       
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión primero.');
        }

        $user = Auth::user();
        
        return view('dashboard', [
            'user' => $user,
            'rolNombre' => $this->getNombreRol($user->Codigo_Rol)
        ]);
    }

    /**
     * Obtener nombre del rol
     */
    private function getNombreRol($codigoRol)
    {
        $roles = [
            1 => 'Técnico',
            2 => 'Cliente',
            3 => 'Administrador'
        ];
        
        return $roles[$codigoRol] ?? 'Usuario';
    }

    /**
     * Mostrar formulario de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Procesar registro de nuevo usuario
     */
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'ID_Usuario' => 'required|string|unique:usuario,ID_Usuario',
            'Nombre' => 'required|string|max:50',
            'Correo' => 'required|email|unique:usuario,Correo',
            'password' => 'required|string|min:6|confirmed',
            'Codigo_Rol' => 'required|in:1,2,3'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        
        $user = User::create([
            'ID_Usuario' => $request->ID_Usuario,
            'Codigo_Documento' => 1, // Valor por defecto
            'Nombre' => $request->Nombre,
            'Fecha_Nacimiento' => now(), // Fecha actual por defecto
            'Direccion' => 'Por definir',
            'Telefono' => '0000000000',
            'Correo' => $request->Correo,
            'Contraseña' => $request->password, 
            'Codigo_Rol' => $request->Codigo_Rol
        ]);

    
        Auth::login($user);

    
        return $this->redirectByRole($user->Codigo_Rol)
                    ->with('success', '¡Cuenta creada exitosamente!');
    }

    /**
     * Perfil de usuario
     */
    public function profile()
    {
        $user = Auth::user();
        
        return view('auth.profile', compact('user'));
    }

    /**
     * Actualizar perfil
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required|string|max:50',
            'Correo' => 'required|email|unique:usuario,Correo,' . $user->ID_Usuario . ',ID_Usuario',
            'Direccion' => 'nullable|string|max:50',
            'Telefono' => 'nullable|string|max:15'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

  
        $user->update([
            'Nombre' => $request->Nombre,
            'Correo' => $request->Correo,
            'Direccion' => $request->Direccion,
            'Telefono' => $request->Telefono
        ]);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Cambiar contraseña
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();


        if (!Hash::check($request->current_password, $user->Contraseña)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }


        $user->update([
            'Contraseña' => $request->new_password
        ]);

        return back()->with('success', 'Contraseña cambiada correctamente.');
    }
}