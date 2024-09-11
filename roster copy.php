<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirige al formulario de inicio de sesión si no hay sesión
    exit();
}

// Consultar los jugadores junto con el nombre del equipo
$sql = "SELECT jugadores.nombre, jugadores.apellido, jugadores.edad, jugadores.numero, jugadores.pais, equipos.nombre AS equipo 
        FROM jugadores 
        INNER JOIN equipos ON jugadores.id_equipo = equipos.id";
$result = $mysqli->query($sql);

// Verificar la conexión
if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roster - Tiburones</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                        <a class="nav-link" href="#">Calendario</a></li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="equiposDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Estadisticas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="equiposDropdown">
                            <li><a class="dropdown-item" href="Pocisiones.php">Pocision</a></li>
                            <li><a class="dropdown-item" href="estadistica_bateo.php">Estadistica Bateo</a></li>
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


    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1>Roster del Equipo Tiburones</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Número</th>
                    <th scope="col">País</th>
                    <th scope="col">Equipo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><a class="dropdown-item" href="perfil_jugador.php?id=<?php echo urlencode($row['nombre']); ?>"><?php echo htmlspecialchars($row['nombre']); ?></a></td>
                    <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($row['edad']); ?></td>
                    <td><?php echo htmlspecialchars($row['numero']); ?></td>
                    <td><?php echo htmlspecialchars($row['pais']); ?></td>
                    <td><?php echo htmlspecialchars($row['equipo']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$mysqli->close();
?>

