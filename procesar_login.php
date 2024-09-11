<?php
session_start();
include 'conexion.php'; // Asegúrate de que este archivo establece la conexión con la base de datos.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar contraseña directamente (sin usar password_verify)
        if ($password === $user['password']) {  // Comparación directa
            $_SESSION['username'] = $user['username'];
            header("Location: administrar.php"); // Redirige al panel de administración
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
