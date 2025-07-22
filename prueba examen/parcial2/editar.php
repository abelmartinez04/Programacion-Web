<?php 
require 'models/conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id ==0) {
    die("Id no valido");
}

$stmt = $conexion->prepare("SELECT * FROM registros  WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$registro = $result->fetch_assoc();
$stmt->close();

if (!$registro) {
    die("No se encontraron registros");
}

if ($_SERVER['REQUEST_METHOD'] ==  'POST'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];

    $sql = "UPDATE registros SET nombre = ?, apellido = ?, telefono = ?, correo_electronico = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $apellido, $telefono, $correo_electronico, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}


$titulo = "Editar Registros";
require 'libreria/plantilla.php';
plantilla::aplicar();
?>

<div class="card shadow p-4">
    <h2 class="mb-4 text-center text-primary"> <?= $titulo ?> </h2>
    <form method="POST" enctype="multipart/form-data" autocomplete="nope">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $registro['nombre'] ?>" required>        
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido" value="<?= $registro['apellido'] ?>" required>        
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="telefono" value="<?= $registro['telefono'] ?>">        
        </div>

        <div class="mb-3">
            <label for="correo_electronico" class="form-label">Correo Electrinico</label>
            <input type="email" class="form-control" name="correo_electronico" value="<?= $registro['correo_electronico'] ?>">        
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>