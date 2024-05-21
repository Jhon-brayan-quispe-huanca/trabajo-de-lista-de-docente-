<?php
require_once '../controller/ProfesorController.php';

$conn = new mysqli($servername, $username, $password, $dbname);
$controller = new ProfesorController($conn);

$update = false;
$id = '';
$nombre = '';
$años = '';
$especialidad = '';

if (isset($_GET['editar'])) {
    $update = true;
    $id = $_GET['editar'];
    $profesor = $controller->obtenerPorId($id);
    $nombre = $profesor['nombre'];
    $años = $profesor['años'];
    $especialidad = $profesor['especialidad'];
}

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
                <?php if ($update): ?>
                    <button type="submit" name="actualizar">OK</button>
                <?php else: ?>
                    <button type="submit" name="guardar">Guardar</button>
                <?php endif; ?>
                <button type="submit" name="nuevo">Nuevo</button>
            </div>
        </form>

        <form action="" method="GET">
            <button type="submit" name="mostrar">Mostrar</button>
        </form>

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
                                if ($row['años'] == 1) {
                                    echo $row['años'] . ' año';
                                } else {
                                    echo $row['años'] . ' años';
                                }
                                ?>
                            </td>
                            <td><?php echo $row['especialidad']; ?></td>
                            <td>
                                <a href="../view/index.php?editar=<?php echo $row['id']; ?>" class="button">Editar</a>
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
$conn->close();
?>
