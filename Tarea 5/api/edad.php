<!-- Abel Martinez - 2024-0227 -->

<?php
include '../plantilla.php';

$nombre = $_GET['nombre'] ?? '';
$mensaje = '';
$imagen = '';

// Función con cURL para obtener la edad desde Agify.io
function obtenerEdad($nombre) {
    $url = "https://api.agify.io/?name=" . urlencode($nombre);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ⚠️ Solo para entorno local
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return ["error" => $error_msg];
    }
    curl_close($ch);
    return json_decode($response, true);
}

if ($nombre) {
    $data = obtenerEdad($nombre);
    if (isset($data['error'])) {
        $mensaje = "Error al obtener datos: " . $data['error'];
    } else {
        $edad = $data['age'] ?? null;
        if ($edad === null) {
            $mensaje = "No se pudo predecir la edad.";
        } elseif ($edad < 18) {
            $mensaje = "Edad estimada: $edad años 👶";
            $imagen = "assets/img/bebe.jpeg";
        } elseif ($edad <= 60) {
            $mensaje = "Edad estimada: $edad años 🧑";
            $imagen = "assets/img/adulto.jpeg";
        } else {
            $mensaje = "Edad estimada: $edad años 👴";
            $imagen = "assets/img/anciano.jpeg";
        }
    }
}

// Contenido HTML
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
