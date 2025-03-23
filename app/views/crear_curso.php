<?php
require_once __DIR__ . '/../controllers/CursoController.php';

// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar autenticación
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Curso</title>
    <link rel="stylesheet" href="../public/css/curso.css">
</head>
<body>
    <div class="form-container">
        <h2>Crear Nuevo Curso</h2>
        <form action="../controllers/CursoController.php?action=crear" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre del Curso:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="abreviacion">Abreviación:</label>
                <input type="text" id="abreviacion" name="abreviacion" required>
            </div>
            
            <div class="form-group">
                <label for="aula">Aula:</label>
                <input type="text" id="aula" name="aula" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
            </div>
            
            <div class="buttons">
                <button type="submit" class="btn-guardar">Crear Curso</button>
                <a href="dashboard.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>