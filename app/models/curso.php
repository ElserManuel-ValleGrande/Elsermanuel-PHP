<?php
require_once __DIR__ . '/../config/database.php';

class Curso {
    private $conn;
    private $table = 'cursos';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function obtenerCursos($usuario_id, $limit, $offset) {
        $sql = "SELECT * FROM $this->table WHERE usuario_id = :usuario_id LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarCursos($usuario_id) {
        $sql = "SELECT COUNT(*) as total FROM $this->table WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function crearCurso($usuario_id, $nombre, $abreviacion, $aula, $descripcion, $icono) {
        $sql = "INSERT INTO $this->table (usuario_id, nombre, abreviacion, aula, descripcion, icono) 
                VALUES (:usuario_id, :nombre, :abreviacion, :aula, :descripcion, :icono)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':abreviacion', $abreviacion);
        $stmt->bindParam(':aula', $aula);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':icono', $icono);
        return $stmt->execute();
    }

    public function actualizarCurso($id, $nombre, $abreviacion, $aula, $descripcion, $icono) {
        $sql = "UPDATE $this->table 
                SET nombre = :nombre, abreviacion = :abreviacion, aula = :aula, 
                    descripcion = :descripcion, icono = :icono
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':abreviacion', $abreviacion);
        $stmt->bindParam(':aula', $aula);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':icono', $icono);
        return $stmt->execute();
    }

    public function eliminarCurso($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
