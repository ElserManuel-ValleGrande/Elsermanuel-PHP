<?php
require_once __DIR__ . '/../../config/database.php';


class Usuario {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function registrarUsuario($nombre, $email, $password) {
        try {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashed_password);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
