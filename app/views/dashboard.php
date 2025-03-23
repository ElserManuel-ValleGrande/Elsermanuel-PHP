<?php 
require_once __DIR__ . '/../controllers/CursoController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$controller = new CursoController();
$totalCursos = $controller->contarCursos();

// paginación
$cursosPerPage = 6;
$totalPages = ceil($totalCursos / $cursosPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Validar
if ($currentPage < 1) {
    $currentPage = 1;
} elseif ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
}

$offset = ($currentPage - 1) * $cursosPerPage;

$cursos = $controller->listarCursosPaginados($offset, $cursosPerPage);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/dashboard-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Bienvenido, <?php echo isset($_SESSION['usuario_nombre']) ? htmlspecialchars($_SESSION['usuario_nombre']) : 'Usuario'; ?>!</h1>
            <div class="acciones">
    <button id="btnCambiarPassword" class="btn-cambiar-password"><i class="fas fa-key"></i> Cambiar Contraseña</button>
    <a href="crear_curso.php" class="btn-crear"><i class="fas fa-plus"></i> Crear Curso</a>
    <button id="btnEliminarCuenta" class="btn-eliminar-cuenta"><i class="fas fa-user-slash"></i> Eliminar Cuenta</button>
    <a href="../controllers/UsuarioController.php?action=logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
</div>
        </header>
        
        <!-- Resto del código del dashboard permanece igual -->
        <h2>Tus Cursos</h2>
        <div class="cursos-grid">
            <?php if (!empty($cursos)): ?>
                <?php foreach ($cursos as $curso): ?>
                    <div class="curso-card">
                        <div class="curso-img">
                            <?php if (!empty($curso['imagen'])): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($curso['imagen']); ?>" alt="Imagen del curso">
                            <?php else: ?>
                                <img src="../public/img/default.png" alt="Sin imagen">
                            <?php endif; ?>
                        </div>
                        <div class="curso-info">
                            <h3><?php echo htmlspecialchars($curso['nombre']); ?></h3>
                            <p><strong>Abreviación:</strong> <?php echo htmlspecialchars($curso['abreviacion']); ?></p>
                            <p><strong>Aula:</strong> <?php echo htmlspecialchars($curso['aula']); ?></p>
                            <p class="descripcion"><?php echo !empty($curso['descripcion']) ? htmlspecialchars($curso['descripcion']) : 'Sin descripción.'; ?></p>
                        </div>
                        <div class="curso-footer">
                            <a href="editar_curso.php?id=<?php echo $curso['id']; ?>" class="btn-editar"><i class="fas fa-edit"></i> Editar</a>
                            <form action="../controllers/CursoController.php?action=eliminar" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este curso?');">
                                <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                                <button type="submit" class="btn-eliminar"><i class="fas fa-trash"></i> Eliminar</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="mensaje-container">
                    <p class="mensaje">No tienes cursos registrados.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="?page=1" class="pagination-link first"><i class="fas fa-angle-double-left"></i></a>
                    <a href="?page=<?php echo $currentPage - 1; ?>" class="pagination-link prev"><i class="fas fa-angle-left"></i></a>
                <?php endif; ?>
                
                <?php
                // Mostrar un número limitado de páginas
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);
                
                if ($startPage > 1) {
                    echo '<span class="pagination-ellipsis">...</span>';
                }
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $activeClass = ($i == $currentPage) ? 'active' : '';
                    echo '<a href="?page=' . $i . '" class="pagination-link ' . $activeClass . '">' . $i . '</a>';
                }
                
                if ($endPage < $totalPages) {
                    echo '<span class="pagination-ellipsis">...</span>';
                }
                ?>
                
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?php echo $currentPage + 1; ?>" class="pagination-link next"><i class="fas fa-angle-right"></i></a>
                    <a href="?page=<?php echo $totalPages; ?>" class="pagination-link last"><i class="fas fa-angle-double-right"></i></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal para cambiar contraseña -->
    <div id="modalCambiarPassword" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Cambiar Contraseña</h2>
            <div id="alertMessage" style="display: none;"></div>
            <form id="formCambiarPassword">
                <div class="form-group">
                    <label for="nuevaPassword">Nueva Contraseña:</label>
                    <input type="password" id="nuevaPassword" name="nuevaPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmarPassword">Confirmar Nueva Contraseña:</label>
                    <input type="password" id="confirmarPassword" name="confirmarPassword" required>
                </div>
                <button type="submit" class="btn-submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <!-- Modal para eliminar cuenta -->
<div id="modalEliminarCuenta" class="modal">
    <div class="modal-content">
        <span class="close-delete">&times;</span>
        <h2>Eliminar Cuenta</h2>
        <p>¿Estás seguro que deseas eliminar tu cuenta? Esta acción no se puede deshacer y perderás todos tus cursos.</p>
        <div class="modal-buttons">
            <button id="btnCancelarEliminacion" class="btn-cancelar">Cancelar</button>
            <a href="../controllers/UsuarioController.php?action=eliminarCuenta" class="btn-confirmar-eliminar">Sí, eliminar mi cuenta</a>
        </div>
    </div>
</div>

    <!-- Script para manejar el modal y el cambio de contraseña -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Modal para cambiar contraseña
    const modalPassword = document.getElementById('modalCambiarPassword');
    const btnAbrirModalPassword = document.getElementById('btnCambiarPassword');
    const btnCerrarModalPassword = document.querySelector('.close');
    const formCambiarPassword = document.getElementById('formCambiarPassword');
    const alertMessage = document.getElementById('alertMessage');

    // Modal para eliminar cuenta
    const modalEliminarCuenta = document.getElementById('modalEliminarCuenta');
    const btnEliminarCuenta = document.getElementById('btnEliminarCuenta');
    const btnCerrarModalEliminar = document.querySelector('.close-delete');
    const btnCancelarEliminacion = document.getElementById('btnCancelarEliminacion');
    
    // Eventos para el modal de cambiar contraseña
    btnAbrirModalPassword.addEventListener('click', function() {
        modalPassword.style.display = 'block';
    });

    btnCerrarModalPassword.addEventListener('click', function() {
        modalPassword.style.display = 'none';
        resetForm();
    });

    // Eventos para el modal de eliminar cuenta
    btnEliminarCuenta.addEventListener('click', function() {
        modalEliminarCuenta.style.display = 'block';
    });
    
    btnCerrarModalEliminar.addEventListener('click', function() {
        modalEliminarCuenta.style.display = 'none';
    });
    
    btnCancelarEliminacion.addEventListener('click', function() {
        modalEliminarCuenta.style.display = 'none';
    });

    // Cerrar modales al hacer clic fuera de ellos
    window.addEventListener('click', function(event) {
        if (event.target == modalPassword) {
            modalPassword.style.display = 'none';
            resetForm();
        }
        if (event.target == modalEliminarCuenta) {
            modalEliminarCuenta.style.display = 'none';
        }
    });

    // Manejo del formulario de cambio de contraseña
    formCambiarPassword.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nuevaPassword = document.getElementById('nuevaPassword').value;
        const confirmarPassword = document.getElementById('confirmarPassword').value;
        
        if (nuevaPassword !== confirmarPassword) {
            mostrarAlerta('Las contraseñas no coinciden', 'danger');
            return;
        }
        
        fetch('../controllers/UsuarioController.php?action=cambiarPassword', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'nueva_password=' + encodeURIComponent(nuevaPassword)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarAlerta(data.message, 'success');
                setTimeout(() => {
                    modalPassword.style.display = 'none';
                    resetForm();
                }, 2000);
            } else {
                mostrarAlerta(data.message, 'danger');
            }
        })
        .catch(error => {
            mostrarAlerta('Error al procesar la solicitud', 'danger');
            console.error('Error:', error);
        });
    });

    function mostrarAlerta(mensaje, tipo) {
        alertMessage.className = 'alert alert-' + tipo;
        alertMessage.textContent = mensaje;
        alertMessage.style.display = 'block';
    }

    function resetForm() {
        formCambiarPassword.reset();
        alertMessage.style.display = 'none';
    }
});
    </script>
</body>
</html>