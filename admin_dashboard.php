<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirige al formulario de inicio de sesión si no hay sesión
    exit();
}
?>

<!-- Aquí va el contenido del panel de administración -->
<h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
