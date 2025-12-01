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
        // Si ya está autenticado, redirigir al dashboard según su rol
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
        // Validación CORREGIDA según tu formulario
        $validator = Validator::make($request->all(), [
            'ID_Usuario' => 'required|string',
            'Codigo_Documento' => 'required|string',
            'password' => 'required|string'
        ], [
            'ID_Usuario.required' => 'El número de documento es requerido',
            'Codigo_Documento.required' => 'El tipo de documento es requerido',
            'password.required' => 'La contraseña es requerida'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Buscar usuario por documento (como se usa en tu formulario)
        $user = User::where('ID_Usuario', $request->ID_Usuario)
                    ->first();

        // Verificar que existe el usuario
        if (!$user) {
            return back()->withErrors([
                'ID_Usuario' => 'Documento no registrado en el sistema.',
            ])->withInput($request->only('ID_Usuario', 'Codigo_Documento', 'remember'));
        }

        // Verificar que el tipo de documento coincida (opcional pero recomendado)
        if ($user->Codigo_Documento != $request->Codigo_Documento) {
            return back()->withErrors([
                'Codigo_Documento' => 'El tipo de documento no coincide con el registrado.',
            ])->withInput($request->only('ID_Usuario', 'Codigo_Documento', 'remember'));
        }

        // Verificar la contraseña
        // IMPORTANTE: Si tu BD tiene contraseñas en texto plano, necesitamos manejarlo diferente
        $passwordValid = false;
        
        // Intentar primero con Hash::check (para contraseñas hasheadas)
        if (Hash::check($request->password, $user->Contraseña)) {
            $passwordValid = true;
        }
        // Si no funciona con hash, verificar texto plano
        elseif ($request->password === $user->Contraseña) {
            $passwordValid = true;
        }

        if ($passwordValid) {
            // Autenticar al usuario
            Auth::login($user, $request->remember ?? false);
            
            // Regenerar sesión
            $request->session()->regenerate();
            
            // Redirigir según rol
            return $this->redirectByRole($user->Codigo_Rol);
        }

        // Si llegamos aquí, la contraseña es incorrecta
        return back()->withErrors([
            'password' => 'La contraseña es incorrecta.',
        ])->withInput($request->only('ID_Usuario', 'Codigo_Documento', 'remember'));
    }

    /**
     * Redirigir según el rol del usuario
     */
    private function redirectByRole($rol)
    {
        switch ($rol) {
            case 1: // Técnico
                return redirect()->route('tecnico.dashboard')->with('success', '¡Bienvenido Técnico!');
                
            case 2: // Cliente
                return redirect()->route('cliente.dashboard')->with('success', '¡Bienvenido Cliente!');
                
            case 3: // Administrador
                return redirect()->route('admin.dashboard')->with('success', '¡Bienvenido Administrador!');
                
            default:
                return redirect('/welcome')->with('success', '¡Bienvenido!');
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
     * Dashboard principal (por si acaso)
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión primero.');
        }

        $user = Auth::user();
        
        // Redirigir según rol en lugar de mostrar un dashboard genérico
        return $this->redirectByRole($user->Codigo_Rol);
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
        // Validación para registro
        $validator = Validator::make($request->all(), [
            'ID_Usuario' => 'required|string|unique:usuario,ID_Usuario',
            'Codigo_Documento' => 'required|in:1,2,3,4,5',
            'Nombre' => 'required|string|max:50',
            'Correo' => 'required|email|unique:usuario,Correo',
            'password' => 'required|string|min:6|confirmed',
            'Codigo_Rol' => 'required|in:1,2,3'
        ], [
            'ID_Usuario.unique' => 'Este número de documento ya está registrado',
            'Correo.unique' => 'Este correo electrónico ya está registrado'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear usuario (hash de contraseña se hará automáticamente si configuras el modelo User)
        $user = User::create([
            'ID_Usuario' => $request->ID_Usuario,
            'Codigo_Documento' => $request->Codigo_Documento,
            'Nombre' => $request->Nombre,
            'Fecha_Nacimiento' => now(), // Fecha actual por defecto
            'Direccion' => 'Por definir',
            'Telefono' => '0000000000',
            'Correo' => $request->Correo,
            'Contraseña' => Hash::make($request->password), // Hash de la contraseña
            'Codigo_Rol' => $request->Codigo_Rol
        ]);

        // Autenticar al usuario después del registro
        Auth::login($user);

        // Redirigir según rol
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

        // Verificar contraseña actual
        $passwordValid = false;
        
        if (Hash::check($request->current_password, $user->Contraseña)) {
            $passwordValid = true;
        }
        // También verificar texto plano por si acaso
        elseif ($request->current_password === $user->Contraseña) {
            $passwordValid = true;
        }

        if (!$passwordValid) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar con hash de la nueva contraseña
        $user->update([
            'Contraseña' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Contraseña cambiada correctamente.');
    }
}
