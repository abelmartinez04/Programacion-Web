<?php
$host = "localhost";
$user = "root";
$pass = "Mybdo*";
$dbname = "la_rubia";

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$db_exists = $conn->query("SHOW DATABASES LIKE '$dbname'");

if ($db_exists && $db_exists->num_rows > 0) {
    header("Location: login.php");
    exit();
} else {
    header("Location: install.php");
    exit();
}
?>
