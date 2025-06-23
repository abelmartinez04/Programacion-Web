<!-- Abel Martinez - 2024-0227 -->

<?php
include '../plantilla.php';

$temperatura = "";
$condicion = "";
$descripcion = "";
$icono = "";
$estilo = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["ciudad"])) {
    $ciudad = htmlspecialchars($_POST["ciudad"], ENT_QUOTES, 'UTF-8');
    $apiKey = "4f0b1464bb075831cbd53136610889b5"; 
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . rawurlencode($ciudad) . ",DO&appid=" . $apiKey . "&units=metric&lang=es";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // solo en local
    $respuesta = curl_exec($ch);

    if ($respuesta) {
        $datos = json_decode($respuesta, true);

        if (isset($datos["main"]["temp"]) && isset($datos["weather"][0]["main"])) {
            $temperatura = $datos["main"]["temp"];
            $condicion = $datos["weather"][0]["main"];
            $descripcion = ucfirst($datos["weather"][0]["description"]);
            $icono = "";
            $estilo = "";

            // Iconos y estilos
            switch (strtolower($condicion)) {
                case "clear":
                    $icono = "☀️";
                    $estilo = "background-color: #fff8dc; color: #000;";
                    break;
                case "rain":
                    $icono = "🌧️";
                    $estilo = "background-color: #cce5ff; color: #000;";
                    break;
                case "clouds":
                    $icono = "☁️";
                    $estilo = "background-color: #e0e0e0; color: #000;";
                    break;
                case "thunderstorm":
                    $icono = "⛈️";
                    $estilo = "background-color: #aab7b8; color: #fff;";
                    break;
                case "snow":
                    $icono = "❄️";
                    $estilo = "background-color: #eaf2f8; color: #000;";
                    break;
                default:
                    $icono = "🌈";
                    $estilo = "background-color: #d6eaf8; color: #000;";
                    break;
            }

            // Mostrar resultado
            $resultado = "
                <div class='mt-4 p-4 rounded' style='$estilo'>
                    <h3>$icono Clima en $ciudad</h3>
                    <p><strong>Temperatura:</strong> $temperatura °C</p>
                    <p><strong>Condición:</strong> $descripcion</p>
                </div>
            ";
        } else {
            $resultado = "<div class='alert alert-warning mt-4'>No se encontró información para la ciudad.</div>";
        }
    } else {
        $resultado = "<div class='alert alert-danger mt-4'>Error al conectar con la API.</div>";
    }

    curl_close($ch);
}

// HTML (usa Bootstrap)
ob_start();
?>
<h2>Clima en República Dominicana 🌦️</h2>
<form method="POST" action="">
    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="Ej. Santo Domingo" required>
    <button type="submit" class="btn btn-primary mt-2">Consultar</button>
</form>

<?= $resultado ?>

<a href="../index.php" class="btn btn-secondary mt-3">Volver al Inicio</a>

<?php
$contenido = ob_get_clean();
mostrarPagina("Clima", $contenido);
?>
