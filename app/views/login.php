<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <form action="../controllers/UsuarioController.php?action=login" method="POST">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Ingresar</button>
    </form>

    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</body>
</html>
