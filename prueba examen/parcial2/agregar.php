<!-- Agregar, por Abel Martinez  -->
<?php 
require 'models/conexion.php';
require 'libreria/plantilla.php';

$titulo = "Agregar Nuevo Personaje";

if ($_SERVER['REQUEST_METHOD'] ==  'POST'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];

    $sql = "INSERT INTO registros (nombre, apellido, telefono, correo_electronico) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $apellido, $telefono, $correo_electronico);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();
}

plantilla::aplicar();
?>


<div class="card shadow p-4">
    <h2 class="mb-4 text-center text-primary"> <?= $titulo ?> </h2>
    <form method="POST" enctype="multipart/form-data" autocomplete="nope">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" autocomplete="off" required>        
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" autocomplete="off" required>        
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" autocomplete="off">        
        </div>

        <div class="mb-3">
            <label for="correo_electronico" class="form-label">Correo Electronico</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="ejemplo@gmail.com" autocomplete="off">        
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>