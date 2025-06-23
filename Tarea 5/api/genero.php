<!-- Abel Martinez - 2024-0227 -->

<?php
include '../plantilla.php';

$nombre = $_GET['nombre'] ?? '';
$mensaje = '';
$color = '';
$genero = '';

if ($nombre) {
    $response = @file_get_contents("https://api.genderize.io/?name=" . urlencode($nombre));
    if ($response) {
        $data = json_decode($response, true);
        $genero = $data['gender'];
        if ($genero == 'male') {
            $mensaje = "Es masculino 💙";
            $color = 'text-primary';
        } elseif ($genero == 'female') {
            $mensaje = "Es femenino 💖";
            $color = 'text-pink';
        } else {
            $mensaje = "No se pudo determinar el género.";
        }
    } else {
        $mensaje = "Error al conectar con la API.";
    }
}

ob_start();
?>

<h2>Predicción de Género</h2>
<form method="get" class="mb-3">
    <input type="text" name="nombre" placeholder="Introduce un nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>">
    <button type="submit" class="btn btn-primary mt-2">Predecir</button>
</form>

<?php if ($mensaje): ?>
    <div class="alert alert-info <?= $color ?>"><?= $mensaje ?></div>
<?php endif; ?>

<?php
$contenido = ob_get_clean();
mostrarPagina("Predicción de Género", $contenido);
?>
