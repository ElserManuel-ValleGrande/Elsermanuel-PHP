<?php 
require_once __DIR__ . '/../controllers/CursoController.php';

// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar que se recibió un ID de curso
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$curso_id = $_GET['id'];
$controller = new CursoController();
$curso = $controller->obtenerCurso($curso_id);

// Si el curso no existe o no pertenece al usuario actual, redirigir
if (!$curso) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/curso.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <h2><i class="fas fa-edit"></i> Editar Curso</h2>
        
        <form action="../controllers/CursoController.php?action=editar" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
            
            <div class="form-group">
                <label for="nombre"><i class="fas fa-book"></i> Nombre del Curso:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($curso['nombre']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="abreviacion"><i class="fas fa-bookmark"></i> Abreviación:</label>
                <input type="text" id="abreviacion" name="abreviacion" value="<?php echo htmlspecialchars($curso['abreviacion']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="aula"><i class="fas fa-door-open"></i> Aula:</label>
                <input type="text" id="aula" name="aula" value="<?php echo htmlspecialchars($curso['aula']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion"><i class="fas fa-align-left"></i> Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($curso['descripcion']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="imagen"><i class="fas fa-image"></i> Imagen:</label>
                <?php if (!empty($curso['imagen'])): ?>
                    <div class="imagen-actual">
                        <p>Imagen actual:</p>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($curso['imagen']); ?>" alt="Imagen del curso">
                    </div>
                <?php endif; ?>
                <input type="file" id="imagen" name="imagen" accept="image/*">
                <p class="help-text">Deja este campo vacío si no deseas cambiar la imagen.</p>
            </div>
            
            <div class="buttons">
                <button type="submit" class="btn-guardar"><i class="fas fa-save"></i> Guardar Cambios</button>
                <a href="dashboard.php" class="btn-cancelar"><i class="fas fa-times"></i> Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>