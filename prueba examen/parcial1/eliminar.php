<!-- Abel Martinez - 2024-0227 -->

<?php
include('libreria/main.php');

plantilla::aplicar();

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>❌ No se especificó la visita a eliminar.</div>";
    echo "<a href='index.php' class='btn btn-secondary'>Volver</a>";
    exit();
}

$cedula = $_GET['id'];
$ruta = 'datos/' . $cedula . '.json';

if (is_file($ruta)) {
    unlink($ruta);
    echo "<div class='alert alert-success'>✅ La visita con cédula <strong>$cedula</strong> ha sido eliminada.</div>";
} else {
    echo "<div class='alert alert-warning'>⚠️ No se encontró la visita con cédula <strong>$cedula</strong>.</div>";
}

echo "<a href='index.php' class='btn btn-primary mt-3'>Volver</a>";
