<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">Mi Portal PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/acerca.php">Acerca de</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownAPIs" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            APIs
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownAPIs">
            <li><a class="dropdown-item" href="/api/genero.php">Predicción de Género</a></li>
            <li><a class="dropdown-item" href="/api/edad.php">Predicción de Edad</a></li>
            <li><a class="dropdown-item" href="/api/universidades.php">Universidades</a></li>
            <li><a class="dropdown-item" href="/api/clima.php">Clima</a></li>
            <li><a class="dropdown-item" href="/api/pokemon.php">Pokémon</a></li>
            <li><a class="dropdown-item" href="/api/noticias.php">Noticias</a></li>
            <li><a class="dropdown-item" href="/api/monedas.php">Monedas</a></li>
            <li><a class="dropdown-item" href="/api/imagenes.php">Imágenes</a></li>
            <li><a class="dropdown-item" href="/api/pais.php">Datos de País</a></li>
            <li><a class="dropdown-item" href="/api/chiste.php">Chiste</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
