<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Curso</title>
    <link rel="stylesheet" href="../public/css/curso.css">
</head>
<body>
    <div class="form-container">
        <h2>Crear Nuevo Curso</h2>
        <form action="../controllers/CursoController.php?action=crear" method="POST" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre del curso" required>
            <input type="text" name="abreviacion" placeholder="Abreviación" required>
            <input type="text" name="aula" placeholder="Aula" required>
            <textarea name="descripcion" placeholder="Descripción" required></textarea>
            <input type="file" name="imagen" accept="image/*" required>
            <button type="submit">Crear Curso</button>
        </form>
    </div>
</body>
</html>
