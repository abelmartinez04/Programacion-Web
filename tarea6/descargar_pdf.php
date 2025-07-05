<?php
require 'conexion.php';
require_once 'vendor/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID inválido.";
    exit;
}

$stmt = $conexion->prepare("SELECT * FROM personajes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$p = $result->fetch_assoc();
$stmt->close();

if (!$p) {
    echo "Personaje no encontrado.";
    exit;
}

$fotoRuta = '';
if (!empty($p['foto'])) {
    $path = realpath($p['foto']);
    if ($path && file_exists($path)) {
        $path = str_replace('\\', '/', $path);
        $fotoRuta = 'file:///' . $path;
    }
}

$html = '
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fef9f4;
        color: #2c2c2c;
    }
    .naruto-card {
        border: 3px solid #f39c12;
        padding: 30px;
        width: 500px;
        margin: auto;
        text-align: center;
        background: #fff8e1;
        box-shadow: 5px 5px 15px rgba(0,0,0,0.2);
    }
    .naruto-card h2 {
        margin: 10px 0;
        color: #e67e22;
        font-size: 24px;
    }
    .naruto-card img {
        width: 160px;
        height: auto;
        margin-bottom: 15px;
        border: 2px solid #e67e22;
    }
    .naruto-label {
        font-weight: bold;
        color: #d35400;
    }
</style>

<div class="naruto-card">';
if ($fotoRuta) {
    $html .= '<img src="' . $fotoRuta . '" alt="Foto de ' . htmlspecialchars($p['nombre']) . '">';
}
$html .= '
    <h2>' . htmlspecialchars($p['nombre']) . '</h2>
    <p><span class="naruto-label">Color:</span> ' . htmlspecialchars($p['color']) . '</p>
    <p><span class="naruto-label">Tipo:</span> ' . htmlspecialchars($p['tipo']) . '</p>
    <p><span class="naruto-label">Nivel:</span> ' . htmlspecialchars($p['nivel']) . '</p>
</div>
';

$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', true);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("perfil_" . preg_replace('/\s+/', '_', $p['nombre']) . ".pdf", ["Attachment" => false]);
