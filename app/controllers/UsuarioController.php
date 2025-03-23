<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/usuario.php';

class UsuarioController {
    public function registro() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = trim($_POST["nombre"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            
            if (empty($nombre) || empty($email) || empty($password)) {
                header("Location: ../views/registro.php?error=Todos los campos son obligatorios");
                exit();
            }
            
            $usuario = new Usuario();
            $resultado = $usuario->registrarUsuario($nombre, $email, $password);
            
            if ($resultado) {
                header("Location: ../views/login.php");
            } else {
                header("Location: ../views/registro.php?error=Error al registrar. Intenta con otro correo.");
            }
            exit();
        }
    }
    
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            
            if (empty($email) || empty($password)) {
                header("Location: ../views/login.php?error=Correo y contraseña requeridos");
                exit();
            }
            
            $usuario = new Usuario();
            $user = $usuario->obtenerUsuarioPorEmail($email);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nombre'] = $user['nombre'];
                header("Location: ../views/dashboard.php");
            } else {
                header("Location: ../views/login.php?error=Credenciales incorrectas");
            }
            exit();
        }
    }
    
    public function logout() {
        session_destroy();
        header("Location: ../views/login.php");
        exit();
    }
    
    public function cambiarPassword() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nueva_password'])) {
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
                exit();
            }
            
            $usuario_id = $_SESSION['usuario_id'];
            $nueva_password = trim($_POST['nueva_password']);
            
            if (empty($nueva_password)) {
                echo json_encode(['success' => false, 'message' => 'La contraseña no puede estar vacía']);
                exit();
            }
            
            $usuario = new Usuario();
            $resultado = $usuario->cambiarPassword($usuario_id, $nueva_password);
            
            if ($resultado) {
                echo json_encode(['success' => true, 'message' => 'Contraseña actualizada correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar la contraseña']);
            }
            exit();
        }
    }

    public function eliminarCuenta() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/login.php");
            exit();
        }
        
        $usuario_id = $_SESSION['usuario_id'];
        $usuario = new Usuario();
        $resultado = $usuario->eliminarCuenta($usuario_id);
        
        if ($resultado) {
            // Destruir la sesión
            session_destroy();
            header("Location: ../views/login.php?mensaje=Cuenta eliminada correctamente");
        } else {
            header("Location: ../views/dashboard.php?error=Error al eliminar la cuenta");
        }
        exit();
    }

}

if (isset($_GET['action'])) {
    $controller = new UsuarioController();
    
    if ($_GET['action'] == 'registro') {
        $controller->registro();
    } elseif ($_GET['action'] == 'login') {
        $controller->login();
    } elseif ($_GET['action'] == 'logout') {
        $controller->logout();
    } elseif ($_GET['action'] == 'cambiarPassword') {
        $controller->cambiarPassword();
    } elseif ($_GET['action'] == 'eliminarCuenta') {
        $controller->eliminarCuenta();
    }
}
?>