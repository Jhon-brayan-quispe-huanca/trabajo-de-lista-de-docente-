<?php
class Profesor {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM profesores";
        return $this->conn->query($query);
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM profesores WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crear($nombre, $años, $especialidad) {
        $query = "INSERT INTO profesores (nombre, años, especialidad) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sis", $nombre, $años, $especialidad);
        return $stmt->execute();
    }

    public function actualizar($id, $nombre, $años, $especialidad) {
        $query = "UPDATE profesores SET nombre = ?, años = ?, especialidad = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sisi", $nombre, $años, $especialidad, $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM profesores WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
