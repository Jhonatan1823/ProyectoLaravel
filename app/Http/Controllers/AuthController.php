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
        // Si ya está autenticado, redirigir según rol
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->Codigo_Rol);
        }
        
        return view('auth.login');
    }

    /**
     * Procesar el login - VERSIÓN OPTIMIZADA
     */
    public function login(Request $request)
    {
        // Validación simplificada
        $request->validate([
            'ID_Usuario' => 'required|string',
            'Codigo_Documento' => 'required|string',
            'password' => 'required|string'
        ], [
            'ID_Usuario.required' => 'El número de documento es requerido',
            'Codigo_Documento.required' => 'El tipo de documento es requerido',
            'password.required' => 'La contraseña es requerida'
        ]);

        // Buscar usuario por documento Y tipo de documento
        $user = User::where('ID_Usuario', $request->ID_Usuario)
                    ->where('Codigo_Documento', $request->Codigo_Documento)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'ID_Usuario' => 'Documento o tipo de documento incorrecto.',
            ])->withInput();
        }

        // VERIFICACIÓN OPTIMIZADA usando el método del modelo
        if (!$user->checkPassword($request->password)) {
            return back()->withErrors([
                'password' => 'La contraseña es incorrecta.',
            ])->withInput();
        }

        // Si la contraseña estaba en texto plano, migrar a hash automáticamente
        if (!$user->isPasswordHashed()) {
            // Esto activará el mutador que hasheará la contraseña
            $user->Contraseña = $request->password;
            $user->save();
        }

        // Autenticar al usuario
        Auth::login($user, $request->remember ?? false);
        
        // Regenerar sesión
        $request->session()->regenerate();
        
        // Redirigir según rol
        return $this->redirectByRole($user->Codigo_Rol);
    }

    /**
     * Redirigir según el rol del usuario
     */
    private function redirectByRole($rol)
    {
        $mensajes = [
            1 => ['ruta' => 'tecnico.dashboard', 'mensaje' => '¡Bienvenido Técnico!'],
            2 => ['ruta' => 'cliente.dashboard', 'mensaje' => '¡Bienvenido Cliente!'],
            3 => ['ruta' => 'admin.dashboard', 'mensaje' => '¡Bienvenido Administrador!']
        ];

        if (isset($mensajes[$rol])) {
            return redirect()->route($mensajes[$rol]['ruta'])
                           ->with('success', $mensajes[$rol]['mensaje']);
        }

        return redirect('/welcome')->with('success', '¡Bienvenido!');
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
     * Dashboard principal (redirección automática)
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return $this->redirectByRole(Auth::user()->Codigo_Rol);
    }

    /**
     * Mostrar formulario de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Procesar registro de nuevo usuario - OPTIMIZADO
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID_Usuario' => 'required|string|unique:usuario,ID_Usuario',
            'Codigo_Documento' => 'required|in:1,2,3,4,5',
            'Nombre' => 'required|string|max:50',
            'Correo' => 'required|email|unique:usuario,Correo',
            'password' => 'required|string|min:6|confirmed',
            'Codigo_Rol' => 'required|in:1,2,3'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear usuario - El mutador en el modelo se encargará del hash automático
        $user = User::create([
            'ID_Usuario' => $request->ID_Usuario,
            'Codigo_Documento' => $request->Codigo_Documento,
            'Nombre' => $request->Nombre,
            'Fecha_Nacimiento' => now(),
            'Direccion' => 'Por definir',
            'Telefono' => '0000000000',
            'Correo' => $request->Correo,
            'Contraseña' => $request->password, // El mutador lo hasheará automáticamente
            'Codigo_Rol' => $request->Codigo_Rol
        ]);

        // Autenticar y redirigir
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
            'Direccion' => 'nullable|string|max:100',
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
     * Cambiar contraseña - OPTIMIZADO
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

        // Verificar contraseña actual usando el método del modelo
        if (!$user->checkPassword($request->current_password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar contraseña (el mutador se encargará del hash)
        $user->update([
            'Contraseña' => $request->new_password
        ]);

        return back()->with('success', 'Contraseña cambiada correctamente.');
    }

    /**
     * Método para hashear todas las contraseñas existentes (SOLO DESARROLLO)
     */
    public function hashExistingPasswords()
    {
        // Solo en desarrollo
        if (app()->environment('production')) {
            abort(403, 'No permitido en producción');
        }

        $users = User::all();
        $updated = 0;

        foreach ($users as $user) {
            // Si no está hasheado y no está vacío
            if (!$user->isPasswordHashed() && !empty($user->Contraseña)) {
                // Esto activará el mutador que hasheará la contraseña
                $user->Contraseña = $user->Contraseña;
                $user->save();
                $updated++;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Se han migrado $updated contraseñas a hash bcrypt",
            'total_usuarios' => $users->count(),
            'actualizados' => $updated
        ]);
    }
}
