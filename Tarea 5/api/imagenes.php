<?php
include '../plantilla.php';

$clave = $_GET['palabra'] ?? '';
$img = '';

if ($clave) {
    $accessKey = "3ygeDi4xtpd_0zUHd4ZCjdTxaacvYgHqVl8K5_h-tOE";
    $url = "https://api.unsplash.com/photos/random?query=" . urlencode($clave) . "&client_id=$accessKey";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // User-Agent necesario para que la API no bloquee
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Solo en entorno local, no en producción
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $img = "<div class='alert alert-danger'>Error de conexión: " . curl_error($ch) . "</div>";
    } else {
        $data = json_decode($response, true);
        if (isset($data['urls']['regular'])) {
            $imgUrl = htmlspecialchars($data['urls']['regular']);
            $desc = htmlspecialchars($data['alt_description'] ?? 'Imagen sin descripción');
            $img = "<img src='$imgUrl' alt='$desc' class='img-fluid mt-3'>";
        } else {
            $msg = $data['errors'][0] ?? 'No se pudo cargar la imagen.';
            $img = "<div class='alert alert-warning'>$msg</div>";
        }
    }
    curl_close($ch);
}

ob_start();
?>
<h2>Generador de Imágenes con IA</h2>
<form method="get">
    <input type="text" name="palabra" class="form-control" placeholder="Ej: naturaleza" value="<?= htmlspecialchars($clave) ?>" required>
    <button type="submit" class="btn btn-dark mt-2">Buscar</button>
</form>
<?= $img ?>
<?php
$contenido = ob_get_clean();
mostrarPagina("Imágenes", $contenido);
?>
