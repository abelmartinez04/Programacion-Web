<?php
include '../plantilla.php';

$pokemon = strtolower($_GET['pokemon'] ?? 'pikachu');
$info = '';

$response = @file_get_contents("https://pokeapi.co/api/v2/pokemon/$pokemon");
if ($response) {
    $data = json_decode($response, true);
    $img = $data['sprites']['front_default'];
    $exp = $data['base_experience'];
    $habilidades = array_map(fn($h) => $h['ability']['name'], $data['abilities']);
    $info = "
        <img src='$img'><h3>" . ucfirst($pokemon) . "</h3>
        <p>Experiencia base: $exp</p>
        <p>Habilidades: " . implode(', ', $habilidades) . "</p>
        <audio controls autoplay><source src='https://pokemoncries.com/cries-old/$pokemon.mp3' type='audio/mpeg'>Tu navegador no soporta audio.</audio>
    ";
} else {
    $info = "<div class='alert alert-danger'>Pokémon no encontrado.</div>";
}

ob_start();
?>
<h2>Información de un Pokémon</h2>
<form method="get">
    <input type="text" name="pokemon" class="form-control" placeholder="Ej: pikachu" value="<?= htmlspecialchars($pokemon) ?>">
    <button type="submit" class="btn btn-warning mt-2">Buscar</button>
</form>
<div class="mt-3"><?= $info ?></div>
<?php
$contenido = ob_get_clean();
mostrarPagina("Pokémon", $contenido);
?>
