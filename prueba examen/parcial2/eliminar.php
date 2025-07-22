<!-- Archivo de eliminar -->
 <?php 
require 'models/conexion.php';
require 'libreria/plantilla.php';


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conexion->prepare("DELETE FROM registros  WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: index.php");
exit;