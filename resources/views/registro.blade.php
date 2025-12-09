<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Celuaccel - Login</title>
  <style>
    /* Estilos - Solo blanco y rojo */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: white;
      min-height: 100vh;
    }
    
    .dashboard-container {
      justify-content: center;
      align-items: center;
      display: flex;
      min-height: 100vh;
    }
    
    .card {
      max-width: 700px;
      width: 100%;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      overflow: hidden;
      border: 1px solid #ffffffff;
    }
    
    .header {
      background: #d20000;
      color: white;
      padding: 20px;
      text-align: center;
    }
    
    .header h1 {
      margin: 0;
      font-size: 24px;
    }
    
    .auth-info {
      margin-top: 10px;
    }
    
    .auth-info button {
      background: white;
      color: #d20000;
      border: none;
      padding: 8px 16px;
      border-radius: 8000px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      font-weight: bold;
    }
    
    .auth-info button:hover {
      background: #333;
      color: white;
    }
    
    .auth-info a {
      text-decoration: none;
    }
    
    .login-container {
      padding: 30px;
      background: white;
    }
    
    .login-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #555;
    }
    
    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px;
      border: 2px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      box-sizing: border-box;
      background: white;
    }
    
    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #d20000;
    }
    
    .btn-login {
      background:white;
      color: #d20000;
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 80000px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
      font-weight: bold;
      transition: background 0.3s ease;
    }
    
    .btn-login:hover {
      background: #333;
    }
    
    .register-link {
      text-align: center;
      margin-top: 12px;
      font-size: 14px;
      color: #555;
    }
    
    .register-link a {
      color: #d20000;
      text-decoration: none;
      font-weight: bold;
    }
    
    .register-link a:hover {
      text-decoration: underline;
    }
    
    .alert {
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: bold;
    }
    
    .alert-danger {
      background: #ffe6e6;
      color: #d20000;
      border: 1px solid #ffb3b3;
    }
    
    .alert-success {
      background: #e6ffe6;
      color: #008000;
      border: 1px solid #99ff99;
    }
  </style>
</head>
<body>
 <div class="dashboard-container">
   <div class="card">
      <header class="header">
        <h1>Celuaccel</h1>
        <div class="auth-info">
          <a href="{{ url('/') }}">
            <button>← Volver</button>
          </a>
        </div>
      </header>

      <main class="login-container">
        <h2>Iniciar Sesión</h2>

        <!-- Mensajes de error/success -->
        @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p class="mb-0">{{ $error }}</p>
            @endforeach
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

<form id="registerForm" action="{{ route('registro.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="ID_Usuario">Documento</label>
        <input type="text" id="ID_Usuario" name="ID_Usuario" placeholder="Documento" required>
    </div>

    <div class="form-group">
        <label for="Codigo_Documento">Tipo de Documento</label>
        <select id="Codigo_Documento" name="Codigo_Documento" required>
            <option selected style="color:rgb(100,100,100)">[ Seleccione el Tipo de Documento ]</option>
            <option value="2">Cédula de Ciudadanía</option>
            <option value="1">Tarjeta de Identidad</option>
            <option value="3">Pasaporte</option>
            <option value="4">NIT</option>
            <option value="5">PEP</option>
        </select>
    </div>

    <div class="form-group">
        <label for="Nombre">Nombre Completo</label>
        <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" required>
    </div>

    <div class="form-group">
        <label for="Fecha_Nacimiento">Fecha de Nacimiento</label>
        <input type="date" id="Fecha_Nacimiento" name="Fecha_Nacimiento" required>
    </div>

    <div class="form-group">
        <label for="Direccion">Dirección</label>
        <input type="text" id="Direccion" name="Direccion" placeholder="Calle # ###-#" required>
    </div>

    <div class="form-group">
        <label for="Telefono">Teléfono</label>
        <input type="number" id="Telefono" name="Telefono" placeholder="#####" required>
    </div>

    <div class="form-group">
        <label for="Correo">Correo Electrónico</label>
        <input type="email" id="Correo" name="Correo" placeholder="ejemplo@correo.com" required>
    </div>

    <div class="form-group">
        <label for="Contraseña">Contraseña</label>
        <input type="password" id="Contraseña" name="Contraseña" placeholder="***" required>
    </div>
    <div class="form-group">
        <label for="ConfirmarContraseña">Confirmar Contraseña</label>
        <input type="password" id="ConfirmarContraseña" name="ConfirmarContraseña" placeholder="***" required>
    </div>


    <!-- Rol fijo oculto -->
    <input type="hidden" name="Codigo_Rol" value="2">

    <button id="registerBtn" type="submit" class="btn-login">Registrarse</button>
</form>
      </main>
    </div>
 </div>

  <script>
    // Estilos que decoran el formulario
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('ID_Usuario').focus();
    });


    document.getElementById('loginForm').addEventListener('submit', function(e) {
      const btn = document.getElementById('loginBtn');
      btn.disabled = true;
      btn.textContent = 'Iniciando sesión...';
    });

    document.getElementById('Codigo_Documento').value = '2';

    document.getElementById('registerForm').addEventListener('submit', function(e) {
    const pass = document.getElementById('Contraseña').value;
    const confirmPass = document.getElementById('ConfirmarContraseña').value;

    if (pass !== confirmPass) {
        e.preventDefault(); // Evita que se envíe el formulario
        alert('Las contraseñas no coinciden. Por favor, verifica.');
    }
});

  </script>
</body>
</html>