<?php
include '../plantilla.php';

$resultado = "";
$conversiones = [];
$usdCantidad = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["cantidad"])) {
    $usdCantidad = floatval($_POST["cantidad"]);

    $url = "https://api.exchangerate-api.com/v4/latest/USD";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Solo si estás en entorno local
    $respuesta = curl_exec($ch);

    if (curl_errno($ch)) {
        $resultado = "Error en la conexión: " . curl_error($ch);
    } else {
        $datos = json_decode($respuesta, true);

        if ($datos && isset($datos["rates"])) {
            $tasas = $datos["rates"];

            $monedas = [
                "DOP" => "Pesos Dominicanos 🇩🇴",
                "EUR" => "Euros 🇪🇺",
                "MXN" => "Pesos Mexicanos 🇲🇽",
                "JPY" => "Yen Japonés 🇯🇵"
            ];

            foreach ($monedas as $codigo => $nombre) {
                if (isset($tasas[$codigo])) {
                    $conversiones[] = [
                        "nombre" => $nombre,
                        "codigo" => $codigo,
                        "valor" => number_format($usdCantidad * $tasas[$codigo], 2, '.', ',')
                    ];
                }
            }

            if (count($conversiones) > 0) {
                $resultado = "Conversión realizada correctamente.";
            } else {
                $resultado = "No se encontraron tasas para las monedas seleccionadas.";
            }
        } else {
            $resultado = "Error al procesar la respuesta de la API.";
        }
    }
    curl_close($ch);
}

ob_start();
?>
<div class="container mt-4">
    <h1 class="text-center">Conversión de Monedas 💰</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad en USD:</label>
            <input type="number" step="0.01" min="0" id="cantidad" name="cantidad" class="form-control" placeholder="Ejemplo: 100" value="<?= htmlspecialchars($usdCantidad) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Convertir</button>
    </form>

    <?php if ($resultado): ?>
        <div class="mt-4">
            <h3><?= $resultado ?></h3>
            <?php if (!empty($conversiones)): ?>
                <ul class="list-group mt-3">
                    <?php foreach ($conversiones as $conversion): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= htmlspecialchars($conversion["nombre"]) ?>
                            <span><?= $conversion["valor"] . " " . htmlspecialchars($conversion["codigo"]) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php
$contenido = ob_get_clean();
mostrarPagina("Conversión de Monedas", $contenido);
?>
