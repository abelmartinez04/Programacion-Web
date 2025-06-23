<?php
include '../plantilla.php';

$response = @file_get_contents("https://jsonplaceholder.typicode.com/posts?_limit=3");
$noticias = $response ? json_decode($response, true) : [];

ob_start();
?>
<h2>Noticias (Demo JSONPlaceholder)</h2>
<?php foreach ($noticias as $n): ?>
    <div class="card mt-3">
        <div class="card-body">
            <h5><?= $n['title'] ?></h5>
            <p><?= $n['body'] ?></p>
        </div>
    </div>
<?php endforeach; ?>
<?php
$contenido = ob_get_clean();
mostrarPagina("Noticias", $contenido);
?>
