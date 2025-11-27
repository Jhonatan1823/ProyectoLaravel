<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Celuaccel - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    
    .dashboard-container {
      justify-content: center;
      align-items: center;
      display: flex;
      min-height: 100vh;
    }
    
    .card {
      max-width: 400px;
      width: 100%;
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .header {
      background: #d20000;
      color: white;
      padding: 20px;
      text-align: center;
      border-radius: 15px 15px 0 0;
    }
    
    .header h1 {
      margin: 0;
      font-size: 24px;
    }
    
    .auth-info {
      margin-top: 10px;
    }
    
    .auth-info button {
      background: #1c1c1c;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
    }
    
    .auth-info button:hover {
      background: #333;
    }
    
    .login-container {
      padding: 30px;
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
    
    .form-group input {
      width: 100%;
      padding: 12px;
      border: 2px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s;
    }
    
    .form-group input:focus {
      outline: none;
      border-color: #d20000;
    }
    
    .login-actions {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }
    
    .login-actions button {
      flex: 1;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    
    .login-actions button[type="submit"] {
      background: #d20000;
      color: white;
    }
    
    .login-actions button[type="submit"]:hover {
      background: #b30000;
    }
    
    .login-actions button[type="button"] {
      background: #1c1c1c;
      color: white;
    }
    
    .login-actions button[type="button"]:hover {
      background: #333;
    }
    
    .text-center {
      text-align: center;
    }
    
    .alert {
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    
    .alert-danger {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    
    .alert-success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <div class="card">
      
      <!-- Header -->
      <header class="header">
        <h1>Celuaccel</h1>
        <div class="auth-info">
          <a href="{{ url('/publico') }}">
            <button type="button">Volver</button>
          </a>
        </div>
      </header>

      <!-- Mensajes de error/success -->
      @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
            <p class="mb-0">{{ $error }}</p>
          @endforeach
        </div>
      @endif

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <!-- Main Content -->
      <main class="login-container">
        <h2>Iniciar Sesión</h2>

        <form action="{{ route('login.submit') }}" method="POST">
          @csrf
          
          <div class="form-group">
            <label for="email">Usuario:</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}" required>
          </div>

          <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
          </div>
          
          <p style="text-align:center;margin-top:12px;font-size:14px;">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
          </p>

          <!-- Botón de login principal -->
          <div class="form-group">
            <button type="submit" style="background:#d20000; color:white; width:100%; padding:12px; border:none; border-radius:8px; cursor:pointer;">
              Iniciar Sesión
            </button>
          </div>

          <!-- Botones de acceso rápido -->
          <div class="login-actions">
            <button type="button" onclick="setDemoUser(2)">Cliente</button>
            <button type="button" onclick="setDemoUser(1)">Técnico</button>
            <button type="button" onclick="setDemoUser(3)">Admin</button>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script>
    // Datos de demo basados en tu BD
    const demoUsers = {
      1: { email: 'joseherre@email.com', password: 'Y6p4nK3W' }, // Técnico
      2: { email: 'carlostorres@email.com', password: 'a9T3xL2q' }, // Cliente
      3: { email: '91820473651', password: 'Y6p4nK3W' } // Admin (por ID)
    };

    function setDemoUser(role) {
      const user = demoUsers[role];
      document.getElementById('email').value = user.email;
      document.getElementById('password').value = user.password;
      
      // Mostrar mensaje de qué usuario se cargó
      const roleNames = {
        1: 'Técnico',
        2: 'Cliente',
        3: 'Administrador'
      };
      
      // Opcional: mostrar alerta de qué usuario se cargó
      alert(`Datos de ${roleNames[role]} cargados. Haz clic en "Iniciar Sesión".`);
    }

    // Opcional: Auto-enfocar el campo email al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('email').focus();
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
