<?php
include 'plantilla.php';
ob_start();
?>

<h2>Acerca del proyecto</h2>
<p>Este portal fue desarrollado usando <strong>Bootstrap 5</strong> por su facilidad de uso, amplia documentación y componentes listos para usar.</p>

<?php
$contenido = ob_get_clean();
mostrarPagina("Acerca de", $contenido);
?>
