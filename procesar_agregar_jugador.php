<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $numero = $_POST['numero'];
    $edad = $_POST['edad'];
    $pais = $_POST['pais'];
    $id_equipo = $_POST['equipo']; // ID del equipo seleccionado

    // Manejo del archivo de la foto
    $fotoNombre = $_FILES['foto']['name'];
    $fotoTmpName = $_FILES['foto']['tmp_name'];
    $fotoSize = $_FILES['foto']['size'];
    $fotoError = $_FILES['foto']['error'];
    $fotoType = $_FILES['foto']['type'];

    $fotoExt = strtolower(pathinfo($fotoNombre, PATHINFO_EXTENSION));
    $extensionesPermitidas = array('jpg', 'jpeg', 'png', 'gif');

    // Verificar que el archivo es una imagen y cumple con las extensiones permitidas
    if (in_array($fotoExt, $extensionesPermitidas) && $fotoError === 0 && $fotoSize < 5000000) {
        $fotoNombreNuevo = uniqid('', true) . "." . $fotoExt;
        $fotoDestino = 'uploads/' . $fotoNombreNuevo;

        if (move_uploaded_file($fotoTmpName, $fotoDestino)) {
            // Insertar los datos del jugador junto con la foto en la base de datos
            $sql = "INSERT INTO jugadores (nombre, apellido, numero, edad, pais, id_equipo, foto) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $mysqli->prepare($sql)) {
                // Enlazar parámetros
                $stmt->bind_param("ssissss", $nombre, $apellido, $numero, $edad, $pais, $id_equipo, $fotoNombreNuevo);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    // Mensaje de éxito y redirección
                    echo "<!DOCTYPE html>
                    <html lang='es'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Jugador Agregado</title>
                        <script>
                            function redirigir() {
                                window.location.href = 'agregar_jugador.php'; // Cambia esto a la URL del formulario
                            }
                            setTimeout(redirigir, 2000); // Redirige después de 2 segundos
                        </script>
                    </head>
                    <body>
                        <h1>Jugador agregado exitosamente</h1>
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
        } else {
            echo "Hubo un error al subir la foto.";
        }
    } else {
        echo "Formato de archivo no permitido o archivo demasiado grande. Solo se permiten JPG, JPEG, PNG y GIF, y un tamaño máximo de 5MB.";
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>


