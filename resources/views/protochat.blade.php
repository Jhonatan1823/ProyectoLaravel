<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Estilos del proto chat */
        .chat-box {
            width: 100%;
            max-width: 500px;
            height: 400px;
            border: 1px solid #ccc;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        .chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
        }
        .chat-message {
            margin-bottom: 10px;
        }
        .chat-message.user {
            text-align: right;
            color: #0d6efd;
        }
        .chat-message.bot {
            text-align: left;
            color: #198754;
        }
        .chat-input {
            display: flex;
            border-top: 1px solid #ccc;
        }
        .chat-input input {
            flex: 1;
            border: none;
            padding: 10px;
        }
        .chat-input button {
            border: none;
            background-color: #0d6efd;
            color: white;
            padding: 10px 15px;
        }
    </style>
</head>
<body style="background-color: #ffffffff;">

<!--Barra de navegacion de arriba-->
<nav class="navbar navbar-expand-lg" style="background-color: #d20000ff;">
  <div class="container-fluid">
    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" style="outline: none; box-shadow: none; border-color: transparent; background-color: #1c1c1cff">
      <i class="fa-solid fa-bars"></i>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a  href="{{ route('welcome') }}"><h1 class="navbar-brand" style="color: white;">Celuaccel</h1></a>
      </div>
      <div class="ms-auto">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-light" style="color:red">
            Cerrar sesión
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>

<center>
  <!-- Proto Chat -->
  <div class="chat-box mt-4">
      <div class="chat-messages" id="chatMessages">
          <div class="chat-message bot">Hola 👋, ¿en qué puedo ayudarte?</div>
      </div>
      <div class="chat-input">
          <input type="text" id="chatInput" placeholder="Escribe un mensaje...">
          <button onclick="sendMessage()">Enviar</button>
      </div>
  </div>
</center>

<script>
    function sendMessage() {
        const input = document.getElementById('chatInput');
        const messages = document.getElementById('chatMessages');
        const text = input.value.trim();

        if(text !== "") {
            // Mensaje del usuario
            const userMsg = document.createElement('div');
            userMsg.classList.add('chat-message', 'user');
            userMsg.textContent = text;
            messages.appendChild(userMsg);

            // Respuesta simulada del bot
            const botMsg = document.createElement('div');
            botMsg.classList.add('chat-message', 'bot');
            botMsg.textContent = "Recibí tu mensaje: " + text;
            messages.appendChild(botMsg);

            // Scroll automático
            messages.scrollTop = messages.scrollHeight;

            // Limpiar input
            input.value = "";
        }
    }
</script>

</body>
</html>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color:#1c1c1cff">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" style="color:white;" id="offcanvasExampleLabel">Menú</h5>

    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

</div>
  <div class="offcanvas-body">
        <div class="container mt-5">
<div class="sidebar">
        <div class="p-3">
            <h5 class="text-white mb-3">Módulos DB</h5>
            <div class="accordion accordion-flush" id="dbAccordion">
@php
$rol = session('user.Codigo_Rol');
@endphp
@if($rol == 2)
                {{-- MÓDULO 1: CATÁLOGO --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-mobile-alt me-2"></i> Catálogo
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('producto.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-box me-2"></i> Productos</a>
                            <a href="{{ route('categoria.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-tags me-2"></i> Categorías</a>
                        </div>
                    </div>
                </div>
@endif

@if($rol == 2)
                {{-- MÓDULO 2: INTERACCIÓN --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-comments me-2"></i> Interacción
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('pregunta.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-question-circle me-2"></i> Preguntas</a>
                            <a href="{{ route('comentarios.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-star me-2"></i> Comentarios</a>
                        </div>
                    </div>
                </div>
@endif

@if($rol == 1)
                {{-- MÓDULO 3: SERVICIOS --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-wrench me-2"></i> Servicios
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('servicio.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-tools me-2"></i> Servicios Activos</a>
                            <a href="{{ route('historial.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-history me-2"></i> Historial</a>
                        </div>
                    </div>
                </div>
@endif

@if($rol == 2)
                {{-- MÓDULO 4: COMUNICACIÓN --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-envelope me-2"></i> Comunicación
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('chat.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-comments-dollar me-2"></i> Chat</a>
                            <a href="{{ route('mensajes.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-paper-plane me-2"></i> Mensajes</a>
                            <a href="{{ route('notificaciones.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-bell me-2"></i> Notificaciones</a>
                        </div>
                    </div>
                </div>
@endif

@if($rol == 3)
                {{-- MÓDULO 5: GESTIÓN BASE (Usuarios y Roles) --}}
                <div class="accordion-item" style="background-color: #1c1c1cff;">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed module-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="background-color: #1c1c1cff; color: white;">
                            <i class="fas fa-users-cog me-2"></i> Gestión Base
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#dbAccordion">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('usuario.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-user me-2"></i> Usuarios</a>
                            <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-user-tag me-2"></i> Roles</a>
                            <a href="{{ route('tipo.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-id-card me-2"></i> Tipos de Documento</a>
                        </div>
                    </div>
                </div>
@endif               
            </div>
        </div>
</div> 