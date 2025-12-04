<style>
    /* Estilos - Solo blanco y rojo */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: white; /* ✅ FONDO BLANCO */
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
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1); /* ✅ Sombra suave */
      overflow: hidden;
      border: 1px solid #e0e0e0; /* ✅ Borde gris claro */
    }
    
    .header {
      background: #d20000; /* ✅ ROJO */
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
      background: white; /* ✅ BLANCO para el botón volver */
      color: #d20000;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
     border-radius: 8000px;
      display: inline-block;
    }
    
    .auth-info button:hover {
      background: #333; /* ✅ GRIS OSCURO al hover */
    }
    
    .auth-info a {
      text-decoration: none;
    }
    
    .login-container {
      padding: 30px;
      background: white; /* ✅ FONDO BLANCO */
    }
    
    .login-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333; /* ✅ TEXTO OSCURO */
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #555; /* ✅ TEXTO GRIS OSCURO */
    }
    
    .form-group input {
      width: 100%;
      padding: 12px;
      border: 2px solid #ddd; /* ✅ BORDES GRIS CLARO */
      border-radius: 8px;
      font-size: 16px;
      box-sizing: border-box;
      background: white; /* ✅ FONDO BLANCO */
    }
    
    .form-group input:focus {
      outline: none;
      border-color: #d20000; /* ✅ BORDE ROJO al enfocar */
    }
    
    .btn-login {
      background: white; /* ✅ ROJO */
      color: #d20000;
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8000px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
      font-weight: bold;
    }
    
    .btn-login:hover {
      background: #333; /* ✅ ROJO OSCURO al hover */
      border-radius: 8000px;
    }
    
    .register-link {
      text-align: center;
      margin-top: 12px;
      font-size: 14px;
      color: #555; /* ✅ TEXTO GRIS */
    }
    
    .register-link a {
      color: #d20000; /* ✅ ENLACE ROJO */
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
      background: #ffe6e6; /* ✅ FONDO ROJO MUY CLARO */
      color: #d20000; /* ✅ TEXTO ROJO */
      border: 1px solid #ffb3b3;
    }
    
    .alert-success {
      background: #e6ffe6; /* ✅ FONDO VERDE MUY CLARO */
      color: #008000; /* ✅ TEXTO VERDE */
      border: 1px solid #99ff99;
    }
    
    .demo-info {
      background: #f5f5f5; /* ✅ FONDO GRIS MUY CLARO */
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 15px;
      margin-top: 20px;
      font-size: 12px;
      color: #666; /* ✅ TEXTO GRIS */
    }
    
    .demo-info strong {
      color: #d20000; /* ✅ TÍTULO ROJO */
    }
  </style>