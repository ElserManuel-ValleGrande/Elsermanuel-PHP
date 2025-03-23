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

    public function eliminarCuenta($usuario_id) {
        try {
            // Comenzar una transacción
            $this->conn->beginTransaction();
            
            // Primero eliminar los cursos asociados al usuario
            $sql_cursos = "DELETE FROM cursos WHERE usuario_id = :usuario_id";
            $stmt_cursos = $this->conn->prepare($sql_cursos);
            $stmt_cursos->bindParam(":usuario_id", $usuario_id);
            $stmt_cursos->execute();
            
            // Luego eliminar la cuenta del usuario
            $sql_usuario = "DELETE FROM usuarios WHERE id = :id";
            $stmt_usuario = $this->conn->prepare($sql_usuario);
            $stmt_usuario->bindParam(":id", $usuario_id);
            $stmt_usuario->execute();
            
            // Confirmar la transacción
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            // Revertir cambios si hay error
            $this->conn->rollBack();
            return false;
        }
    }
}
?>