<?php
require_once '../db.php';
require_once '../model/Profesor.php';

class ProfesorController {
    private $model;

    public function __construct($conn) {
        $this->model = new Profesor($conn);
    }

    public function manejarSolicitud() {
        if (isset($_POST['guardar'])) {
            $this->crearProfesor();
        } elseif (isset($_POST['actualizar'])) {
            $this->actualizarProfesor();
        } elseif (isset($_GET['eliminar'])) {
            $this->eliminarProfesor();
        }
    }

    private function crearProfesor() {
        $nombre = $_POST['nombre'];
        $años = $_POST['años'];
        $especialidad = $_POST['especialidad'];
        $this->model->crear($nombre, $años, $especialidad);
        header("Location: ../view/index.php");
    }

    private function actualizarProfesor() {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $años = $_POST['años'];
        $especialidad = $_POST['especialidad'];
        $this->model->actualizar($id, $nombre, $años, $especialidad);
        header("Location: ../view/index.php");
    }

    private function eliminarProfesor() {
        $id = $_GET['eliminar'];
        $this->model->eliminar($id);
        header("Location: ../view/index.php");
    }

    public function obtenerTodos() {
        return $this->model->obtenerTodos();
    }

    public function obtenerPorId($id) {
        return $this->model->obtenerPorId($id);
    }
}

// Iniciar el controlador y manejar la solicitud
$conn = new mysqli($servername, $username, $password, $dbname);
$controller = new ProfesorController($conn);
$controller->manejarSolicitud();
?>
