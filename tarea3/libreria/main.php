<?php 

include("modelos.php");
include("plantilla.php");

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

?>