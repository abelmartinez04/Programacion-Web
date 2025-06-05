<?php 

include("modelos.php");
include("plantilla.php");
include("Dbx.php");

function base_url($path = ""){
    //protocol
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'on' ? "https://" : "http://";
    //host
    $host = $_SERVER['HTTP_HOST'];
    
    //path
    $path = trim($path, "/");

    //return full url
    return $protocol . $host . "/" . $path;
}

function cargar_eliminar($collection)
{
    if (!defined("PAGINA_ACTUAL")) {
        define("PAGINA_ACTUAL", $collection);
        plantilla::aplicar();
    }

    // Variables
    $ruta = "libreria/datax/$collection";
    $idx = isset($_GET['idx']) ? $_GET['idx'] : "";
    $file = "{$ruta}/{$idx}dat";

    // Manejar error
    if ($idx === "" || !is_dir($ruta) || !file_exists($file)) {
        echo "
        <div class='text-center'>
            <div class='alert alert-danger'>Error al encontrar el objeto!</div>
            <a href='lista_per.php' class='btn btn-primary'>Volver</a>
        </div>
        ";

        exit;
    }

    // Eliminar archivo
    unlink($file);
    echo "<div class='text-center'><div class='alert alert-success'>Eliminado exitosamente!</div>";
    echo "<a href='lista.php' class='btn btn-primary'>Volver</a></div>";
}
?>