<?php
require_once __DIR__ . '/../models/usuario.php';
session_start();

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // Registrar
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->usuarioModel->registrar($nombre, $email, $password)) {
                header("Location: ../views/login.php?registro=exitoso");
            } else {
                echo "Error al registrar usuario.";
            }
        }
    }

    // Iniciar sesión
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = $this->usuarioModel->login($email, $password);
            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                header("Location: ../views/cursos.php");
            } else {
                echo "Credenciales incorrectas.";
            }
        }
    }

    // Cerrar sesión
    public function logout() {
        session_destroy();
        header("Location: ../views/login.php");
    }

    // Cambiar contraseña
    public function cambiarPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['usuario_id'];
            $nuevaPassword = $_POST['nuevaPassword'];

            if ($this->usuarioModel->cambiarPassword($id, $nuevaPassword)) {
                echo "Contraseña actualizada correctamente.";
            } else {
                echo "Error al cambiar la contraseña.";
            }
        }
    }

    // Eliminar
    public function eliminarCuenta() {
        if (isset($_SESSION['usuario_id'])) {
            $id = $_SESSION['usuario_id'];
            if ($this->usuarioModel->eliminarUsuario($id)) {
                session_destroy();
                header("Location: ../views/login.php");
            } else {
                echo "Error al eliminar la cuenta.";
            }
        }
    }
}

// Manejo de acciones desde formularios
if (isset($_GET['action'])) {
    $controller = new UsuarioController();
    
    if ($_GET['action'] === 'registrar') {
        $controller->registrar();
    } elseif ($_GET['action'] === 'login') {
        $controller->login();
    } elseif ($_GET['action'] === 'logout') {
        $controller->logout();
    } elseif ($_GET['action'] === 'cambiarPassword') {
        $controller->cambiarPassword();
    } elseif ($_GET['action'] === 'eliminarCuenta') {
        $controller->eliminarCuenta();
    }
}
?>
