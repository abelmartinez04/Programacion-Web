<?php
require 'models/conexion.php';



$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) {
    die("Id no valido");
}

$stmt = $conexion->prepare("SELECT * FROM registros WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$registro = $result->fetch_assoc();
$stmt->close();

if (!$registro) {
    die("Registro no encontrado");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $sql ="UPDATE registros SET nombre = ?, apellido = ?, telefono = ?, correo_electronico = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssisi", $nombre, $apellido, $telefono, $correo, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}

$titulo = "Editar Visita";
require 'libreria/plantilla.php';
plantilla::aplicar();
?>


<div class="card shadow p-4">
    <h2 class="mb-4 text-center text-primary">Editar Visita</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= $registro['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= $registro['apellido'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" name="telefono" class="form-control" value="<?= $registro['telefono'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electronico</label>
            <input type="text" name="correo_electronico" class="form-control" value="<?= $registro['correo_electronico'] ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>

