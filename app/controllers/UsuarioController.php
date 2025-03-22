<?php
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
}

if (isset($_GET['action']) && $_GET['action'] == 'registro') {
    $controller = new UsuarioController();
    $controller->registro();
}
?>
