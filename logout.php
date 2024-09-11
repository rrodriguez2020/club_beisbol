<?php
session_start();
session_destroy();
header("Location: login.php"); // Redirige al formulario de inicio de sesión después de cerrar sesión
exit();
?>
