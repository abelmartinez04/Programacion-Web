<?php
require 'models/conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("ID no válido");
}

$stmt = $conexion->prepare("SELECT * FROM personajes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$personaje = $result->fetch_assoc();
$stmt->close();

if (!$personaje) {
    die("Personaje no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $color = $_POST['color'];
    $tipo = $_POST['tipo'];
    $nivel = $_POST['nivel'];
    $rutaFoto = $personaje['foto'];

    if (!empty($_FILES['foto']['name'])) {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        if (!empty($personaje['foto']) && file_exists($personaje['foto'])) {
            unlink($personaje['foto']);
        }
        $fotoNombre = time() . "_" . basename($_FILES['foto']['name']);
        $rutaFoto = 'uploads/' . $fotoNombre;
        move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFoto);
    }

    $sql = "UPDATE personajes SET nombre = ?, color = ?, tipo = ?, nivel = ?, foto = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssisi", $nombre, $color, $tipo, $nivel, $rutaFoto, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}

$titulo = "Editar Personaje";
require 'libreria/plantilla.php';
?>

<div class="card shadow p-4">
    <h2 class="mb-4 text-center text-primary">Editar perfil de <?= htmlspecialchars($personaje['nombre']) ?></h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nombre del Personaje</label>
            <input type="text" name="nombre" class="form-control" value="<?= $personaje['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control" value="<?= $personaje['color'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo / Rol</label>
            <input type="text" name="tipo" class="form-control" value="<?= $personaje['tipo'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Nivel</label>
            <input type="number" name="nivel" class="form-control" value="<?= $personaje['nivel'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Foto actual</label><br>
            <img src="<?= $personaje['foto'] ?>" width="100" class="img-thumbnail mb-2">
            <input type="file" name="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
