<style>
  #hola {
    color: #0d6efd;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a id="hola" class="navbar-brand fas fa-home" href="welcome.php"> SAREJ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link" href="documentacion.php"><i class="fas fa-eye"></i> Documentación</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="people.php"><i class="fas fa-user-friends"></i> Personas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registrar.php"><i class="far fa-user-circle"></i> Crear cuenta</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            CUENTA
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="cambiar_clave.php">Cambiar Contraseña</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
