<?php
include '../plantilla.php';

$pais = $_GET['pais'] ?? 'dominican republic';
$info = '';

function obtenerDatosPais($nombrePais) {
    $url = "https://restcountries.com/v3.1/name/" . urlencode($nombrePais);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Solo en entorno local
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        curl_close($ch);
        return ['error' => 'Error de conexión: ' . curl_error($ch)];
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode != 200) {
        return ['error' => 'País no encontrado o error en la API.'];
    }

    $data = json_decode($response, true);

    if (!is_array($data) || empty($data)) {
        return ['error' => 'Respuesta inválida de la API.'];
    }

    return $data[0];
}

if ($pais) {
    $datos = obtenerDatosPais($pais);

    if (isset($datos['error'])) {
        $info = "<div class='alert alert-danger'>{$datos['error']}</div>";
    } else {
        $nombre = $datos['name']['common'] ?? 'N/A';
        $bandera = $datos['flags']['png'] ?? '';
        $capital = $datos['capital'][0] ?? 'N/A';
        $poblacion = isset($datos['population']) ? number_format($datos['population']) : 'N/A';

        // Obtener monedas
        $monedas = [];
        if (isset($datos['currencies']) && is_array($datos['currencies'])) {
            foreach ($datos['currencies'] as $codigo => $detalle) {
                $monedas[] = $detalle['name'] ?? $codigo;
            }
        }
        $moneda = implode(', ', $monedas) ?: 'N/A';

        $info = "
            <h3>$nombre</h3>
            " . ($bandera ? "<img src='$bandera' width='150' alt='Bandera de $nombre'><br>" : "") . "
            <strong>Capital:</strong> $capital<br>
            <strong>Población:</strong> $poblacion<br>
            <strong>Moneda(s):</strong> $moneda
        ";
    }
}

ob_start();
?>
<h2>Datos de un País</h2>
<form method="get">
    <input type="text" name="pais" class="form-control" placeholder="Nombre del país en inglés" value="<?= htmlspecialchars($pais) ?>" required>
    <button type="submit" class="btn btn-info mt-2">Buscar</button>
</form>
<div class="mt-3"><?= $info ?></div>
<?php
$contenido = ob_get_clean();
mostrarPagina("País", $contenido);
?>
