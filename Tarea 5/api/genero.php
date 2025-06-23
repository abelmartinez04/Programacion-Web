<!-- Abel Martinez - 2024-0227 -->

<?php
include '../plantilla.php';

$nombre = $_GET['nombre'] ?? '';
$mensaje = '';
$color = '';
$genero = '';

if ($nombre) {
    $apiUrl = "https://api.genderize.io/?name=" . urlencode($nombre);
    
    // Usar cURL que es más confiable que file_get_contents
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Solo para desarrollo, quitar en producción
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        $mensaje = "Error de conexión: " . curl_error($ch);
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            $mensaje = "La API devolvió el código HTTP: " . $httpCode;
        } else {
            $data = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $mensaje = "Error al decodificar la respuesta JSON";
            } else {
                $genero = $data['gender'] ?? null;
                if ($genero == 'male') {
                    $mensaje = "Es masculino 💙";
                    $color = 'text-primary';
                } elseif ($genero == 'female') {
                    $mensaje = "Es femenino 💖";
                    $color = 'text-pink';
                } else {
                    $mensaje = "No se pudo determinar el género.";
                }
            }
        }
    }
    curl_close($ch);
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