<?php
include '../plantilla.php';

$cantidad = $_GET['usd'] ?? '';
$mensaje = '';

if (is_numeric($cantidad)) {
    $response = @file_get_contents("https://api.exchangerate-api.com/v4/latest/USD");
    if ($response) {
        $data = json_decode($response, true);
        $d = $data['rates']['DOP'] ?? 0;
        $e = $data['rates']['EUR'] ?? 0;
        $mensaje = "
            <p>\${$cantidad} USD = " . ($cantidad * $d) . " DOP</p>
            <p>\${$cantidad} USD = " . ($cantidad * $e) . " EUR</p>
        ";
    } else {
        $mensaje = "No se pudo obtener la tasa.";
    }
}

ob_start();
?>
<h2>Conversión de Monedas</h2>
<form method="get">
    <input type="number" name="usd" class="form-control" placeholder="Cantidad en USD" value="<?= htmlspecialchars($cantidad) ?>">
    <button type="submit" class="btn btn-secondary mt-2">Convertir</button>
</form>
<div class="mt-3"><?= $mensaje ?></div>
<?php
$contenido = ob_get_clean();
mostrarPagina("Conversión de Monedas", $contenido);
?>
