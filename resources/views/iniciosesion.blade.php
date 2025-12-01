<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<body style="background-color: #ffffffff;">
   <!--Barra de navegacion de arriba-->
<nav class="navbar navbar-expand-lg" style="background-color: #d20000ff;">
  <div class="container-fluid">
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a href="{{ route('index') }}" style="text-decoration: none;font-size:35px;color: white;">Celuaccel</a>
      </div>
    </div>
  </div>
</nav>
<br>
<br>
<br>
<br>
<center>
<div class="card" style="width:400px">
  <h4 class="card-header"style="background-color:red;color:white;">Celuaccel</h4>
  <div class="card-body">
    <h5 class="card-title">Iniciar Sesion</h5>
    
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
        </ul>
      </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('iniciosesion.post') }}">
        @csrf
        <label class="form-label">Tipo de Documento</label>
        <select type="number" class="form-select" aria-label="Default select example"  id="Codigo_Documento" name="Codigo_Documento" required>
            <option selected style="color:rgb(100,100,100)">[Seleccione un Documento]</option>
            <option value="1">Cedula de Ciudadania</option>
            <option value="2">Tarjeta de Identidad</option>
            <option value="3">Cedula de Extranjeria</option>
            <option value="4">Pasaporte</option>
            <option value="5">PEP</option>
        </select>
        <p class="card-text">Numero de Documento</p>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">#</span>
            <input type="text" class="form-control" placeholder="Documento" aria-label="Documento" aria-describedby="addon-wrapping" id="ID_Usuario" name="ID_Usuario" required>
        </div>
        <p class="card-text">Contraseña</p>
        <div class="input-group flex-nowrap">
            <span class="input-group-text">***</span>
            <input type="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="addon-wrapping" id="Contraseña" name="Contraseña" required>
        </div>
        <br>
        <button type="submit" class="btn btn-danger">Enviar</button>
    </form>
       
  </div>
</div>
</center>
</body>
</html>

