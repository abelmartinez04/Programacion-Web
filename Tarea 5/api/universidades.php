<?php
include '../plantilla.php';

$pais = $_GET['pais'] ?? '';
$universidades = [];

if ($pais) {
    $response = @file_get_contents("http://universities.hipolabs.com/search?country=" . urlencode($pais));
    if ($response) {
        $universidades = json_decode($response, true);
    } else {
        $mensaje = "No se pudo obtener la información.";
    }
}

ob_start();
?>
<h2>Universidades por País</h2>
<form method="get">
    <input type="text" name="pais" class="form-control" placeholder="Ej: Dominican Republic" value="<?= htmlspecialchars($pais) ?>">
    <button type="submit" class="btn btn-dark mt-2">Buscar</button>
</form>

<?php if ($universidades): ?>
    <ul class="list-group mt-3">
        <?php foreach ($universidades as $uni): ?>
            <li class="list-group-item">
                <strong><?= $uni['name'] ?></strong><br>
                <?= $uni['web_pages'][0] ?> | <?= $uni['domains'][0] ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php elseif ($pais): ?>
    <div class="alert alert-warning mt-3">No se encontraron universidades.</div>
<?php endif; ?>
<?php
$contenido = ob_get_clean();
mostrarPagina("Universidades", $contenido);
?>
