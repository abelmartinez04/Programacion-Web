<?php
require 'models/conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sqlFoto = $conexion->prepare("SELECT foto FROM personajes WHERE id = ?");
    $sqlFoto->bind_param("i", $id);
    $sqlFoto->execute();
    $sqlFoto->bind_result($foto);
    $sqlFoto->fetch();
    $sqlFoto->close();

    if (!empty($foto) && file_exists($foto)) {
        unlink($foto);
    }

    $sql = $conexion->prepare("DELETE FROM personajes WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $sql->close();
}

header("Location: index.php");
exit;
?>
