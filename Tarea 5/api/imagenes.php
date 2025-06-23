<?php
include '../plantilla.php';

$clave = $_GET['palabra'] ?? '';
$img = '';

if ($clave) {
    $accessKey = "TU_UNSPLASH_KEY";
    $url = "https://api.unsplash.com/photos/random?query=" . urlencode($clave) . "&client_id=$accessKey";
    $response = @file_get_contents($url);
    if ($response) {
        $data = json_decode($response, true);
        $img = "<img src='" . $data['urls']['regular'] . "' class='img-fluid mt-3'>";
    } else {
        $img = "<div class='alert alert-danger'>No se pudo cargar la imagen.</div>";
    }
}

ob_start();
?>
<h2>Generador de Imágenes con IA</h2>
<form method="get">
    <input type="text" name="palabra" class="form-control" placeholder="Ej: naturaleza" value="<?= htmlspecialchars($clave) ?>">
    <button type="submit" class="btn btn-dark mt-2">Buscar</button>
</form>
<?= $img ?>
<?php
$contenido = ob_get_clean();
mostrarPagina("Imágenes", $contenido);
?>
