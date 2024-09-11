<?php
// Conexión a la base de datos
include 'conexion.php'; // Ajusta este archivo según tu configuración

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    $telefono = $_POST['telefono'];

    // Insertar los datos del equipo en la base de datos
    $sql = "INSERT INTO equipos (nombre, direccion, localidad, telefono) 
            VALUES (?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Enlazar parámetros
        $stmt->bind_param("ssss", $nombre, $direccion, $localidad, $telefono);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Mensaje de éxito y redirección
            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Equipo Agregado</title>
                <script>
                    function redirigir() {
                        window.location.href = 'agregar_equipo.php'; // Cambia esto a la URL del formulario
                    }
                    setTimeout(redirigir, 2000); // Redirige después de 2 segundos
                </script>
            </head>
            <body>
                <h1>Equipo agregado exitosamente</h1>
            </body>
            </html>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>
