<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php"); // Si ya está logueado, redirigir al index
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles-registro.css">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>

    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red'>" . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>

    <form action="../controllers/UsuarioController.php?action=registro" method="POST">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
</body>
</html>
