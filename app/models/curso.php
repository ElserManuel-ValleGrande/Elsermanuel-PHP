<?php
require_once __DIR__ . '/../../config/database.php';

class Curso {
    private $conn;
    private $table = 'cursos';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function obtenerCursos($usuario_id) {
        $sql = "SELECT id, nombre, abreviacion, aula, descripcion, imagen FROM $this->table WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearCurso($usuario_id, $nombre, $abreviacion, $aula, $descripcion, $imagen) {
        $sql = "INSERT INTO $this->table (usuario_id, nombre, abreviacion, aula, descripcion, imagen) 
                VALUES (:usuario_id, :nombre, :abreviacion, :aula, :descripcion, :imagen)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':abreviacion', $abreviacion);
        $stmt->bindParam(':aula', $aula);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        return $stmt->execute();
    }
}
?>
