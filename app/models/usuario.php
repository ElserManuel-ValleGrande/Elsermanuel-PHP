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
    
    public function cambiarPassword($usuario_id, $nueva_password) {
        try {
            $hashed_password = password_hash($nueva_password, PASSWORD_BCRYPT);
            $sql = "UPDATE usuarios SET password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->bindParam(":id", $usuario_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>