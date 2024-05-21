<?php
// Incluimos el archivo de configuración de la base de datos y el modelo Profesor
require_once '../db.php';
require_once '../model/Profesor.php';

class ProfesorController {
    private $model;

    // Constructor que inicializa el modelo con la conexión a la base de datos
    public function __construct($conn) {
        $this->model = new Profesor($conn);
    }

    // Método que maneja las solicitudes del formulario
    public function manejarSolicitud() {
        // Verifica si se envió la solicitud para guardar un nuevo profesor
        if (isset($_POST['guardar'])) {
            $this->crearProfesor();
        // Verifica si se envió la solicitud para actualizar un profesor existente
        } elseif (isset($_POST['actualizar'])) {
            $this->actualizarProfesor();
        // Verifica si se envió la solicitud para eliminar un profesor
        } elseif (isset($_GET['eliminar'])) {
            $this->eliminarProfesor();
        }
    }

    // Método para crear un nuevo profesor
    private function crearProfesor() {
        // Recoge los datos del formulario
        $nombre = $_POST['nombre'];
        $años = $_POST['años'];
        $especialidad = $_POST['especialidad'];

        // Llama al método del modelo para crear el profesor
        $this->model->crear($nombre, $años, $especialidad);

        // Redirige a la vista principal después de guardar
        header("Location: ../view/index.php");
    }

    // Método para actualizar un profesor existente
    private function actualizarProfesor() {
        // Recoge los datos del formulario
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $años = $_POST['años'];
        $especialidad = $_POST['especialidad'];

        // Llama al método del modelo para actualizar el profesor
        $this->model->actualizar($id, $nombre, $años, $especialidad);

        // Redirige a la vista principal después de actualizar
        header("Location: ../view/index.php");
    }

    // Método para eliminar un profesor
    private function eliminarProfesor() {
        // Recoge el ID del profesor a eliminar
        $id = $_GET['eliminar'];

        // Llama al método del modelo para eliminar el profesor
        $this->model->eliminar($id);

        // Redirige a la vista principal después de eliminar
        header("Location: ../view/index.php");
    }

    // Método para obtener todos los profesores
    public function obtenerTodos() {
        // Llama al método del modelo para obtener todos los profesores
        return $this->model->obtenerTodos();
    }

    // Método para obtener un profesor por su ID
    public function obtenerPorId($id) {
        // Llama al método del modelo para obtener un profesor por su ID
        return $this->model->obtenerPorId($id);
    }
}

// Inicia la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicia el controlador y maneja la solicitud
$controller = new ProfesorController($conn);
$controller->manejarSolicitud();
?>
