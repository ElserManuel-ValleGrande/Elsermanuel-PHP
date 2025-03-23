<?php
require_once __DIR__ . '/../models/Curso.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CursoController {
    private $cursoModel;
    
    public function __construct() {
        $this->cursoModel = new Curso();
    }
    
    // Listar cursos del usuario actual
    public function listarCursos() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/login.php");
            exit();
        }
        return $this->cursoModel->obtenerCursos($_SESSION['usuario_id']);
    }
    
    // Nuevo método para listar cursos con paginación
    public function listarCursosPaginados($offset, $limit) {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/login.php");
            exit();
        }
        return $this->cursoModel->obtenerCursosPaginados($_SESSION['usuario_id'], $offset, $limit);
    }
    
    // Nuevo método para contar el total de cursos
    public function contarCursos() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/login.php");
            exit();
        }
        return $this->cursoModel->contarCursos($_SESSION['usuario_id']);
    }
    
    // Crear un nuevo curso
    public function crearCurso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'];
            $nombre = $_POST['nombre'];
            $abreviacion = $_POST['abreviacion'];
            $aula = $_POST['aula'];
            $descripcion = $_POST['descripcion'];
            
            // Verificar si se subió una imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0 && $_FILES['imagen']['error'] == 0) {
                $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
            } else {
                $imagen = null; // No hay imagen
            }
            
            if ($this->cursoModel->crearCurso($usuario_id, $nombre, $abreviacion, $aula, $descripcion, $imagen)) {
                header("Location: ../views/dashboard.php");
                exit();
            } else {
                echo "Error al crear el curso.";
            }
        }
    }
    
    // Obtener un curso por ID
    public function obtenerCurso($id) {
        return $this->cursoModel->obtenerCursoPorId($id);
    }
    
    // Editar un curso existente
    public function editarCurso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si el usuario está autenticado
            if (!isset($_SESSION['usuario_id'])) {
                header("Location: ../views/login.php");
                exit();
            }
            
            $curso_id = $_POST['curso_id'];
            $nombre = $_POST['nombre'];
            $abreviacion = $_POST['abreviacion'];
            $aula = $_POST['aula'];
            $descripcion = $_POST['descripcion'];
            
            // Verificar si se subió una nueva imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0 && $_FILES['imagen']['error'] == 0) {
                $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
            } else {
                $imagen = null; // Mantener la imagen actual
            }
            
            if ($this->cursoModel->editarCurso($curso_id, $nombre, $abreviacion, $aula, $descripcion, $imagen)) {
                header("Location: ../views/dashboard.php");
                exit();
            } else {
                echo "Error al editar el curso.";
            }
        }
    }
    
    // Eliminar un curso
    public function eliminarCurso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si el usuario está autenticado
            if (!isset($_SESSION['usuario_id'])) {
                header("Location: ../views/login.php");
                exit();
            }
            
            $curso_id = $_POST['curso_id'];
            
            if ($this->cursoModel->eliminarCurso($curso_id)) {
                header("Location: ../views/dashboard.php");
                exit();
            } else {
                echo "Error al eliminar el curso.";
            }
        }
    }
    
}

// Manejo de las acciones solicitadas
if (isset($_GET['action'])) {
    $controller = new CursoController();
    
    switch ($_GET['action']) {
        case 'crear':
            $controller->crearCurso();
            break;
        case 'editar':
            $controller->editarCurso();
            break;
        case 'eliminar':
            $controller->eliminarCurso();
            break;
        default:
            header("Location: ../views/dashboard.php");
            exit();
    }
}
?>