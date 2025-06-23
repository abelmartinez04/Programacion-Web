<?php
include '../plantilla.php';

$pagina = $_GET['pagina'] ?? '';
$noticias = [];
$logo = '';
$error = '';

if ($pagina) {
    // Limpiar la URL para que no tenga slash final
    $pagina = rtrim($pagina, '/');

    // URL para obtener posts
    $url_posts = $pagina . '/wp-json/wp/v2/posts?per_page=3&_embed';

    // Obtener datos con cURL
    $ch = curl_init($url_posts);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // solo en local
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200 && $response) {
        $noticias = json_decode($response, true);

        // Obtener logo si está en _embedded
        if (!empty($noticias[0]['_embedded']['wp:featuredmedia'][0]['source_url'])) {
            $logo = $noticias[0]['_embedded']['wp:featuredmedia'][0]['source_url'];
        }
    } else {
        $error = "No se pudo obtener noticias de esa página.";
    }
}

ob_start();
?>

<h2>Noticias desde WordPress 📰</h2>

<form method="get" class="mb-3">
    <label for="pagina">URL base de página WordPress:</label>
    <input type="url" name="pagina" id="pagina" class="form-control" placeholder="https://ejemplo.com" value="<?= htmlspecialchars($pagina) ?>" required>
    <button type="submit" class="btn btn-primary mt-2">Obtener noticias</button>
</form>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<?php if ($noticias): ?>
    <?php if ($logo): ?>
        <div class="mb-3">
            <img src="<?= htmlspecialchars($logo) ?>" alt="Logo" style="max-height:80px;">
        </div>
    <?php endif; ?>

    <?php foreach ($noticias as $post): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5><?= htmlspecialchars($post['title']['rendered']) ?></h5>
                <p><?= strip_tags($post['excerpt']['rendered']) ?></p>
                <a href="<?= htmlspecialchars($post['link']) ?>" target="_blank" class="btn btn-sm btn-info">Leer más</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php
$contenido = ob_get_clean();
mostrarPagina("Noticias", $contenido);

/*Ejemplos de sitios
https://wordpress.org/news

*/
?>
