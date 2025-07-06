<?php
require 'models/conexion.php';
require 'libreria/plantilla.php';

$titulo = "Agregar Nuevo Personaje";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $color = $_POST['color'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $nivel = $_POST['nivel'] ?? '';

    $rutaFoto = '';
    if (!empty($_FILES['foto']['name'])) {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        $fotoNombre = time() . "_" . basename($_FILES['foto']['name']); 
        $rutaFoto = 'uploads/' . $fotoNombre;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFoto)) {
        } else {
            echo "⚠️ Error al subir la imagen.";
            exit;
        }
    }


    $sql = "INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssis", $nombre, $color, $tipo, $nivel, $rutaFoto);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}
?>

<div class="card shadow p-4">
    <h2 class="mb-4 text-center text-primary">Agregar Nuevo Personaje</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nombre del Personaje</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo / Rol</label>
            <input type="text" name="tipo" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Nivel</label>
            <input type="number" name="nivel" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Personaje</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>