<?php
include '../plantilla.php';

$nombre = $_GET['nombre'] ?? '';
$mensaje = '';
$imagen = '';

if ($nombre) {
    $response = @file_get_contents("https://api.agify.io/?name=" . urlencode($nombre));
    if ($response) {
        $data = json_decode($response, true);
        $edad = $data['age'];
        if ($edad < 18) {
            $mensaje = "Edad estimada: $edad años 👶";
            $imagen = "assets/img/bebe.png";
        } elseif ($edad <= 60) {
            $mensaje = "Edad estimada: $edad años 🧑";
            $imagen = "assets/img/adulto.png";
        } else {
            $mensaje = "Edad estimada: $edad años 👴";
            $imagen = "assets/img/anciano.png";
        }
    } else {
        $mensaje = "Error al obtener datos.";
    }
}

ob_start();
?>
<h2>Predicción de Edad</h2>
<form method="get">
    <input type="text" name="nombre" placeholder="Introduce un nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>">
    <button type="submit" class="btn btn-success mt-2">Predecir</button>
</form>
<?php if ($mensaje): ?>
    <div class="alert alert-info mt-3"><?= $mensaje ?></div>
    <?php if ($imagen): ?>
        <img src="../<?= $imagen ?>" alt="Edad" width="120">
    <?php endif; ?>
<?php endif; ?>
<?php
$contenido = ob_get_clean();
mostrarPagina("Predicción de Edad", $contenido);
?>
