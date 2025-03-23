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
    
    // Nuevo método para paginación
    public function obtenerCursosPaginados($usuario_id, $offset, $limit) {
        $sql = "SELECT id, nombre, abreviacion, aula, descripcion, imagen FROM $this->table 
                WHERE usuario_id = :usuario_id 
                ORDER BY id DESC 
                LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Nuevo método para contar total de cursos
    public function contarCursos($usuario_id) {
        $sql = "SELECT COUNT(*) as total FROM $this->table WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    public function obtenerCursoPorId($id) {
        $sql = "SELECT id, nombre, abreviacion, aula, descripcion, imagen FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function crearCurso($usuario_id, $nombre, $abreviacion, $aula, $descripcion, $imagen = null) {
        try {
            $sql = "INSERT INTO $this->table (usuario_id, nombre, abreviacion, aula, descripcion, imagen) 
                    VALUES (:usuario_id, :nombre, :abreviacion, :aula, :descripcion, :imagen)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':abreviacion', $abreviacion);
            $stmt->bindParam(':aula', $aula);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            // En producción, registrar el error en un archivo de log en lugar de mostrarlo
            error_log("Error al crear curso: " . $e->getMessage());
            return false;
        }
    }
    
    public function editarCurso($curso_id, $nombre, $abreviacion, $aula, $descripcion, $imagen = null) {
        try {
            // Verificar si se proporcionó una nueva imagen
            if ($imagen !== null) {
                $sql = "UPDATE $this->table SET nombre = :nombre, abreviacion = :abreviacion, 
                        aula = :aula, descripcion = :descripcion, imagen = :imagen 
                        WHERE id = :curso_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
            } else {
                $sql = "UPDATE $this->table SET nombre = :nombre, abreviacion = :abreviacion, 
                        aula = :aula, descripcion = :descripcion WHERE id = :curso_id";
                $stmt = $this->conn->prepare($sql);
            }
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':abreviacion', $abreviacion);
            $stmt->bindParam(':aula', $aula);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
            
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            error_log("Error al editar curso: " . $e->getMessage());
            return false;
        }
    }
    
    public function eliminarCurso($curso_id) {
        try {
            $sql = "DELETE FROM $this->table WHERE id = :curso_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            error_log("Error al eliminar curso: " . $e->getMessage());
            return false;
        }
    }
    
    public function verificarPropiedadCurso($curso_id, $usuario_id) {
        $sql = "SELECT id FROM $this->table WHERE id = :curso_id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
?>