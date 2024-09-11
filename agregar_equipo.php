<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirige al formulario de inicio de sesión si no hay sesión
    exit();
}

//include 'admin_dashboard.php'; // Asegúrate de ajustar este archivo según tu configuración
// Consultar los jugadores junto con el nombre del equipo
$sql = "SELECT id, nombre, direccion, localidad, telefono 
        FROM equipos";
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
    <title>Agregar Equipo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de Navegación -->
    <?php
// Barra de Navegacion
include 'nav.php'; 
?>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1>Agregar Equipo</h1>
        <form action="procesar_agregar_equipo.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Equipo:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="localidad" class="form-label">Localidad:</label>
                <input type="text" class="form-control" id="localidad" name="localidad" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Equipo</button>
        </form>
    </div>

    <!-- Contenido Secundario -->
    <div class="container mt-4">
        <h1>Equipos Agregados</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Localidad</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th> <!-- Nueva columna para acciones -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                    <td><?php echo htmlspecialchars($row['localidad']); ?></td>
                    <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                    <td>
                        <!-- Botón de edición -->
                        <a href="editar_equipo.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
