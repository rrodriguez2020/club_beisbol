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
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Agregar Jugador - Tiburones</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
       <!-- Barra de Navegación -->
<?php
include 'nav.php';
?>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1>Agregar Jugador al Equipo Tiburones</h1>
        <form action="procesar_agregar_jugador.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Primera Columna -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número:</label>
                        <input type="number" class="form-control" id="numero" name="numero"  min="0" required>
                    </div>
                </div>

                <!-- Segunda Columna -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="edad" class="form-label">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="edad" name="edad" required>
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label">País:</label>
                        <input type="text" class="form-control" id="pais" name="pais" required>
                    </div>
                    <div class="mb-3">
                        <label for="equipo" class="form-label">Equipo:</label>
                        <select class="form-select" id="equipo" name="equipo" required>
                            <!-- Opciones de equipos se llenarán dinámicamente desde la base de datos -->
                            <?php
                            // Ejemplo de PHP para generar opciones dinámicamente
                            $equipos = [ // Debes reemplazar este array con una consulta a tu base de datos
                                ['id' => 1, 'nombre' => 'Tiburones A2'],
                                ['id' => 2, 'nombre' => 'Tiburones A3']
                            ];
                            foreach ($equipos as $equipo) {
                                echo "<option value='{$equipo['id']}'>{$equipo['nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Campo de Foto en una Nueva Fila -->
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto del Jugador:</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                    </div>
                </div>
            </div>

            <!-- Botón de envío -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Agregar Jugador</button>
            </div>
        </form>
    </div>

     <!-- Contenido principal -->
     <div class="container mt-4">
        <h1>Jugadores Agregados</h1>
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
