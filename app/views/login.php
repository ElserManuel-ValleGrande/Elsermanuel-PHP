<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../public/css/styles-login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <?php if (isset($_GET['error'])): ?>
            <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="../controllers/UsuarioController.php?action=login" method="POST">
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>

        <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
</body>
</html>
