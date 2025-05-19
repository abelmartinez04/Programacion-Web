<?php 
$tituloPagina = "Resultado";
require('partes/head.php'); 



// var_dump($_GET);
$num1 = $_GET['num1'];
$num2 = $_GET['num2'];
$operacion = $_GET['operacion'];
$resultado = "";


switch ($operacion) {
    case "suma":
        $resultado = $num1 + $num2;
        break;
    case "resta":
        $resultado = $num1 - $num2;
        break;
    case "multiplicacion":
        $resultado = $num1 * $num2;
        break;
    case "division":
        if ($num2 != 0) {
            $resultado = $num1 / $num2;
        } else {
            $resultado = "No se puede dividir entre cero.";
        }
        break;
    default:
        $resultado = "Operación no válida.";
        exit();
}

if (is_numeric($resultado)) {
    $resultado = number_format($resultado, 2);
}

?>

<h3>Resultado: <?= $resultado ?></h3>

<a href="calculadora.php">← Volver a la calculadora</a>

<?php require('partes/bottom.php'); ?>