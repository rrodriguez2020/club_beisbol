<?php
session_start();

// Verificar si el usuario no está logueado
if (!isset($_SESSION['username'])) {
    // Si el usuario no está logueado, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
?>
