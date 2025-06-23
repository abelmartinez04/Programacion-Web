<?php
include '../plantilla.php';

$pokemon = strtolower($_GET['pokemon'] ?? 'pikachu');
$info = '';

function obtenerDatosPokemon($nombre) {
    $url = "https://pokeapi.co/api/v2/pokemon/$nombre";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return null;
    }
    return json_decode($resp, true);
}

// Obtenemos los datos
$data = obtenerDatosPokemon($pokemon);

if ($data) {
    $img = $data['sprites']['front_default'] ?? '';
    $exp = $data['base_experience'] ?? 'N/A';
    $habilidades = array_map(fn($h) => ucfirst($h['ability']['name']), $data['abilities'] ?? []);

    // URL del audio — usando pokemoncries.com que tiene mp3 para muchos pokes
    // Aseguramos que el nombre solo tenga letras minúsculas y guiones bajos, porque ahí lo usan así
    $audioNombre = str_replace(' ', '-', strtolower($pokemon));
    $audioUrl = "https://pokemoncries.com/cries-old/$audioNombre.mp3";

    // Comprobamos si el audio existe (opcional pero recomendado)
    $headers = @get_headers($audioUrl);
    $audioExiste = $headers && strpos($headers[0], '200') !== false;

    $info = "
        <div style='text-align:center;'>
            <img src='$img' alt='Imagen de $pokemon' style='width:150px;'>
            <h3>" . ucfirst($pokemon) . "</h3>
            <p><strong>Experiencia base:</strong> $exp</p>
            <p><strong>Habilidades:</strong> " . implode(', ', $habilidades) . "</p>";

    if ($audioExiste) {
        $info .= "
            <audio controls autoplay style='margin-top:10px;'>
                <source src='$audioUrl' type='audio/mpeg'>
                Tu navegador no soporta audio.
            </audio>";
    } else {
        $info .= "<p><em>Sonido no disponible para este Pokémon.</em></p>";
    }

    $info .= "</div>";
} else {
    $info = "<div class='alert alert-danger'>Pokémon no encontrado.</div>";
}

ob_start();
?>
<h2>Información de un Pokémon ⚡</h2>
<form method="get">
    <input type="text" name="pokemon" class="form-control" placeholder="Ej: pikachu" value="<?= htmlspecialchars($pokemon) ?>">
    <button type="submit" class="btn btn-warning mt-2">Buscar</button>
</form>
<div class="mt-3"><?= $info ?></div>
<?php
$contenido = ob_get_clean();
mostrarPagina("Pokémon", $contenido);
?>
