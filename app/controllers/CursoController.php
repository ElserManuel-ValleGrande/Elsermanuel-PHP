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

    public function listarCursos() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/login.php");
            exit();
        }
        return $this->cursoModel->obtenerCursos($_SESSION['usuario_id']);
    }

    public function crearCurso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'];
            $nombre = $_POST['nombre'];
            $abreviacion = $_POST['abreviacion'];
            $aula = $_POST['aula'];
            $descripcion = $_POST['descripcion'];
            
            // Procesar imagen
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

            if ($this->cursoModel->crearCurso($usuario_id, $nombre, $abreviacion, $aula, $descripcion, $imagen)) {
                header("Location: ../views/dashboard.php");
            } else {
                echo "Error al crear curso.";
            }
        }
    }
}

if (isset($_GET['action'])) {
    $controller = new CursoController();

    if ($_GET['action'] === 'crear') {
        $controller->crearCurso();
    }
}
?>
