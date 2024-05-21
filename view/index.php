<?php
// Incluir el controlador de Profesor
require_once '../controller/ProfesorController.php';

// Crear una instancia de conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Crear una instancia del controlador de Profesor
$controller = new ProfesorController($conn);

// Variables para el formulario y la edición
$update = false;
$id = '';
$nombre = '';
$años = '';
$especialidad = '';

// Verificar si se está solicitando la edición de un profesor
if (isset($_GET['editar'])) {
    $update = true;
    $id = $_GET['editar'];
    // Obtener los datos del profesor por su ID
    $profesor = $controller->obtenerPorId($id);
    $nombre = $profesor['nombre'];
    $años = $profesor['años'];
    $especialidad = $profesor['especialidad'];
}

// Obtener todos los profesores
$profesores = $controller->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Profesores</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>CRUD Profesores</h1>
        <!-- Formulario para añadir o editar un profesor -->
        <form action="../controller/ProfesorController.php" method="POST">
            <div class="form-group">
                <label>ID:</label>
                <input type="text" name="id" value="<?php echo $id; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="form-group">
                <label>Años:</label>
                <input type="text" name="años" value="<?php echo $años; ?>">
            </div>
            <div class="form-group">
                <label>Especialidad:</label>
                <input type="text" name="especialidad" value="<?php echo $especialidad; ?>">
            </div>
            <div class="buttons">
                <!-- Mostrar botón para actualizar o guardar nuevo profesor -->
                <?php if ($update): ?>
                    <button type="submit" name="actualizar">Actualizar</button>
                <?php else: ?>
                    <button type="submit" name="guardar">Guardar</button>
                <?php endif; ?>
                <button type="submit" name="nuevo">Nuevo</button>
            </div>
        </form>

        <!-- Formulario para mostrar todos los profesores -->
        <form action="" method="GET">
            <button type="submit" name="mostrar">Mostrar Todos</button>
        </form>

        <!-- Tabla para mostrar todos los profesores -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Años</th>
                        <th>Especialidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $profesores->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td>
                                <?php
                                // Mostrar "año" o "años" según el valor de 'años'
                                if ($row['años'] == 1) {
                                    echo $row['años'] . ' año';
                                } else {
                                    echo $row['años'] . ' años';
                                }
                                ?>
                            </td>
                            <td><?php echo $row['especialidad']; ?></td>
                            <td>
                                <!-- Enlace para editar el profesor -->
                                <a href="../view/index.php?editar=<?php echo $row['id']; ?>" class="button">Editar</a>
                                <!-- Enlace para eliminar el profesor -->
                                <a href="../controller/ProfesorController.php?eliminar=<?php echo $row['id']; ?>" class="button delete-button">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
