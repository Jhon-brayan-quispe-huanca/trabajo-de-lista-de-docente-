<?php
class Profesor {
    private $conn; // Variable para almacenar la conexión a la base de datos.

    // Constructor de la clase que recibe la conexión como parámetro.
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para obtener todos los registros de la tabla 'profesores'.
    public function obtenerTodos() {
        $query = "SELECT * FROM profesores"; // Consulta SQL para seleccionar todos los registros.
        return $this->conn->query($query); // Ejecutar la consulta y devolver el resultado.
    }

    // Método para obtener un registro de la tabla 'profesores' por su ID.
    public function obtenerPorId($id) {
        $query = "SELECT * FROM profesores WHERE id = ?"; // Consulta SQL con un parámetro de ID.
        $stmt = $this->conn->prepare($query); // Preparar la consulta.
        $stmt->bind_param("i", $id); // Vincular el parámetro de ID.
        $stmt->execute(); // Ejecutar la consulta.
        return $stmt->get_result()->fetch_assoc(); // Obtener y devolver el resultado como un array asociativo.
    }

    // Método para crear un nuevo registro de profesor en la base de datos.
    public function crear($nombre, $años, $especialidad) {
        $query = "INSERT INTO profesores (nombre, años, especialidad) VALUES (?, ?, ?)"; // Consulta SQL para insertar un nuevo registro.
        $stmt = $this->conn->prepare($query); // Preparar la consulta.
        $stmt->bind_param("sis", $nombre, $años, $especialidad); // Vincular los parámetros de nombre, años y especialidad.
        return $stmt->execute(); // Ejecutar la consulta y devolver true si se realizó correctamente.
    }

    // Método para actualizar un registro de profesor en la base de datos.
    public function actualizar($id, $nombre, $años, $especialidad) {
        $query = "UPDATE profesores SET nombre = ?, años = ?, especialidad = ? WHERE id = ?"; // Consulta SQL para actualizar un registro por su ID.
        $stmt = $this->conn->prepare($query); // Preparar la consulta.
        $stmt->bind_param("sisi", $nombre, $años, $especialidad, $id); // Vincular los parámetros de nombre, años, especialidad e ID.
        return $stmt->execute(); // Ejecutar la consulta y devolver true si se realizó correctamente.
    }

    // Método para eliminar un registro de profesor de la base de datos por su ID.
    public function eliminar($id) {
        $query = "DELETE FROM profesores WHERE id = ?"; // Consulta SQL para eliminar un registro por su ID.
        $stmt = $this->conn->prepare($query); // Preparar la consulta.
        $stmt->bind_param("i", $id); // Vincular el parámetro de ID.
        return $stmt->execute(); // Ejecutar la consulta y devolver true si se realizó correctamente.
    }
}
?>
