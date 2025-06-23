<?php
include '../plantilla.php';

$ciudad = $_GET['ciudad'] ?? 'Santo Domingo';
$apiKey = 'TU_API_KEY_OPENWEATHER';  // reemplazar
$url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($ciudad) . "&appid=$apiKey&units=metric&lang=es";

$info = '';
if ($ciudad) {
    $response = @file_get_contents($url);
    if ($response) {
        $data = json_decode($response, true);
        $clima = $data['weather'][0]['description'];
        $temp = $data['main']['temp'];
        $icon = $data['weather'][0]['icon'];
        $info = "<h4>$ciudad</h4><p>$clima, $temp °C</p><img src='https://openweathermap.org/img/wn/$icon@2x.png'>";
    } else {
        $info = "<div class='alert alert-danger'>No se pudo obtener el clima.</div>";
    }
}

ob_start();
?>
<h2>Clima Actual</h2>
<form method="get">
    <input type="text" name="ciudad" class="form-control" placeholder="Ciudad" value="<?= htmlspecialchars($ciudad) ?>">
    <button type="submit" class="btn btn-primary mt-2">Consultar</button>
</form>
<div class="mt-3"><?= $info ?></div>
<?php
$contenido = ob_get_clean();
mostrarPagina("Clima", $contenido);
?>
