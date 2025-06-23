<?php
include '../plantilla.php';

$pais = $_GET['pais'] ?? 'dominican';
$info = '';

$response = @file_get_contents("https://restcountries.com/v3.1/name/$pais");
if ($response) {
    $data = json_decode($response, true)[0];
    $nombre = $data['name']['common'];
    $bandera = $data['flags']['png'];
    $capital = $data['capital'][0];
    $poblacion = $data['population'];
    $moneda = implode(', ', array_keys($data['currencies']));
    $info = "
        <h3>$nombre</h3>
        <img src='$bandera' width='150'><br>
        Capital: $capital<br>
        Población: $poblacion<br>
        Moneda: $moneda
    ";
} else {
    $info = "<div class='alert alert-danger'>No se encontró el país.</div>";
}

ob_start();
?>
<h2>Datos de un País</h2>
<form method="get">
    <input type="text" name="pais" class="form-control" placeholder="Nombre en inglés" value="<?= htmlspecialchars($pais) ?>">
    <button type="submit" class="btn btn-info mt-2">Buscar</button>
</form>
<div class="mt-3"><?= $info ?></div>
<?php
$contenido = ob_get_clean();
mostrarPagina("País", $contenido);
?>
