<?php
// Conectar a la base de datos
include 'conexion.php'; // Ajusta la conexión según tu configuración

// Verificar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $equipo_id = $_GET['id'];

    // Obtener los detalles del equipo de la base de datos
    $sql = "SELECT id, nombre, direccion, localidad, telefono FROM equipos WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $equipo_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si el equipo existe
        if ($result->num_rows == 1) {
            $equipo = $result->fetch_assoc();
        } else {
            echo "Equipo no encontrado.";
            exit;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
        exit;
    }
} else {
    echo "ID de equipo no proporcionado.";
    exit;
}

// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    $telefono = $_POST['telefono'];

    // Actualizar los datos del equipo en la base de datos
    $sql = "UPDATE equipos SET nombre = ?, direccion = ?, localidad = ?, telefono = ? WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sssii", $nombre, $direccion, $localidad, $telefono, $equipo_id);

        if ($stmt->execute()) {
            // Redirigir a la página de equipos con un mensaje de éxito
            header("Location: agregar_equipo.php?mensaje=editado");
            exit;
        } else {
            echo "Error al actualizar el equipo: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
    }
}

// Cerrar la conexión
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Editar Equipo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
// Barra de Navegacion
include 'nav.php'; 
?>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1>Editar Equipo</h1>
        <form action="editar_equipo.php?id=<?php echo $equipo_id; ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Equipo:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($equipo['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($equipo['direccion']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="localidad" class="form-label">Localidad:</label>
                <input type="text" class="form-control" id="localidad" name="localidad" value="<?php echo htmlspecialchars($equipo['localidad']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($equipo['telefono']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
