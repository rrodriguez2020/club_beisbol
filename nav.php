  <!-- Barra de Navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/Logo.png" alt="Logo del Club" width="30" height="30" class="d-inline-block align-text-top">
                Club de Béisbol
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="equiposDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Equipos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="equiposDropdown">
                            <li><a class="dropdown-item" href="roster.php">Tiburones</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resultados.php">Resultados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calendario.php">Calendario</a></li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="equiposDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Estadisticas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="equiposDropdown">
                            <li><a class="dropdown-item" href="Pocisiones.php">Pocision</a></li>
                            <li><a class="dropdown-item" href="estadistica_bateo_jugador.php">Estadistica Bateo</a></li>
                            <li><a class="dropdown-item" href="estadistica_picheo.php">Estadistica Picheo</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="administrarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="administrarDropdown">
                            <?php if (isset($_SESSION['username'])): ?>
                                <li><a class="dropdown-item" href="agregar_jugador.php">Agregar Jugador</a></li>
                                <li><a class="dropdown-item" href="agregar_resultado.php">Agregar Resultado</a></li>
                                <li><a class="dropdown-item" href="agregar_equipo.php">Agregar Equipo</a></li>
                                <li><a class="dropdown-item" href="estadistica_bateo.php">Agregar Estadística Bateo</a></li>
                                <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>