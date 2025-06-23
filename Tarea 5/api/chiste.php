<?php
include '../plantilla.php';

function obtenerChiste() {
    $url = "https://official-joke-api.appspot.com/random_joke";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // solo local
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        curl_close($ch);
        return null;
    }

    curl_close($ch);
    return json_decode($response, true);
}

$chiste = obtenerChiste();

ob_start();
?>
<h2>Chiste Aleatorio</h2>
<?php if ($chiste && isset($chiste['setup']) && isset($chiste['punchline'])): ?>
    <div class="alert alert-success">
        <strong><?= htmlspecialchars($chiste['setup']) ?></strong><br>
        <?= htmlspecialchars($chiste['punchline']) ?>
    </div>
<?php else: ?>
    <div class="alert alert-danger">No se pudo cargar el chiste.</div>
<?php endif; ?>
<form method="get">
    <button type="submit" class="btn btn-primary mt-3">Generar otro chiste</button>
</form>
<?php
$contenido = ob_get_clean();
mostrarPagina("Chiste", $contenido);
?>
