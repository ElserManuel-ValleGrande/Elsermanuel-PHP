<?php
require_once __DIR__ . '/../controllers/CursoController.php';

$controller = new CursoController();
$cursos = $controller->listarCursos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/css/dashboard-style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>!</h1>
            <div class="acciones">
                <a href="crear_curso.php" class="btn-crear"><i class="fas fa-plus"></i> Crear Curso</a>
                <a href="../controllers/UsuarioController.php?action=logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
            </div>
        </header>

        <h2>Tus Cursos</h2>
        <div class="cursos-grid">
            <?php foreach ($cursos as $curso): ?>
                <div class="curso-card">
                    <div class="curso-img">
                        <?php if ($curso['imagen']): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($curso['imagen']); ?>" alt="Imagen del curso">
                        <?php else: ?>
                            <img src="../public/img/default.png" alt="Sin imagen">
                        <?php endif; ?>
                    </div>
                    <div class="curso-info">
                        <h3><?php echo htmlspecialchars($curso['nombre']); ?></h3>
                        <p><strong>Abreviación:</strong> <?php echo htmlspecialchars($curso['abreviacion']); ?></p>
                        <p><strong>Aula:</strong> <?php echo htmlspecialchars($curso['aula']); ?></p>
                        <p class="descripcion"><?php echo htmlspecialchars($curso['descripcion']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
