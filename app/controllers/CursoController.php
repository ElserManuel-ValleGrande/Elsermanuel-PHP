<?php
require_once __DIR__ . '/../models/curso.php';
session_start();

class CursoController {
    private $cursoModel;

    public function __construct() {
        $this->cursoModel = new Curso();
    }

    // Obtener cursos con paginación
    public function listarCursos($pagina = 1, $limite = 5) {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/login.php");
            exit();
        }

        $usuario_id = $_SESSION['usuario_id'];
        $offset = ($pagina - 1) * $limite;
        $cursos = $this->cursoModel->obtenerCursos($usuario_id, $limite, $offset);
        $totalCursos = $this->cursoModel->contarCursos($usuario_id);
        $totalPaginas = ceil($totalCursos / $limite);

        include '../views/cursos.php';
    }

    // Crear curso
    public function crearCurso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'];
            $nombre = $_POST['nombre'];
            $abreviacion = $_POST['abreviacion'];
            $aula = $_POST['aula'];
            $descripcion = $_POST['descripcion'];
            $icono = $_POST['icono'];

            if ($this->cursoModel->crearCurso($usuario_id, $nombre, $abreviacion, $aula, $descripcion, $icono)) {
                header("Location: ../views/cursos.php");
            } else {
                echo "Error al crear curso.";
            }
        }
    }

    // Actualizar curso
    public function actualizarCurso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $abreviacion = $_POST['abreviacion'];
            $aula = $_POST['aula'];
            $descripcion = $_POST['descripcion'];
            $icono = $_POST['icono'];

            if ($this->cursoModel->actualizarCurso($id, $nombre, $abreviacion, $aula, $descripcion, $icono)) {
                header("Location: ../views/cursos.php");
            } else {
                echo "Error al actualizar curso.";
            }
        }
    }

    // Eliminar curso
    public function eliminarCurso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            if ($this->cursoModel->eliminarCurso($id)) {
                header("Location: ../views/cursos.php");
            } else {
                echo "Error al eliminar curso.";
            }
        }
    }
}

if (isset($_GET['action'])) {
    $controller = new CursoController();

    if ($_GET['action'] === 'listar') {
        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
        $controller->listarCursos($pagina);
    } elseif ($_GET['action'] === 'crear') {
        $controller->crearCurso();
    } elseif ($_GET['action'] === 'actualizar') {
        $controller->actualizarCurso();
    } elseif ($_GET['action'] === 'eliminar') {
        $controller->eliminarCurso();
    }
}
?>
