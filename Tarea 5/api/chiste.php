<?php
include '../plantilla.php';

$response = @file_get_contents("https://official-joke-api.appspot.com/random_joke");
$chiste = $response ? json_decode($response, true) : [];

ob_start();
?>
<h2>Chiste Aleatorio</h2>
<?php if ($chiste): ?>
    <div class="alert alert-success">
        <strong><?= $chiste['setup'] ?></strong><br>
        <?= $chiste['punchline'] ?>
    </div>
<?php else: ?>
    <div class="alert alert-danger">No se pudo cargar el chiste.</div>
<?php endif; ?>
<?php
$contenido = ob_get_clean();
mostrarPagina("Chiste", $contenido);
?>
