<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: app/views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?> </h2>

    <a href="controllers/UsuarioController.php?action=logout">Cerrar Sesión</a>

    <h3>Listado de Cursos</h3>
    <a href="views/crear_curso.php">Agregar Nuevo Curso</a>

    <?php include 'controllers/CursoController.php'; 
          $controller = new CursoController();
          $controller->listarCursos();
    ?>
</body>
</html>
