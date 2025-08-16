<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$archivo = '../data/usuarios.json';

if (!file_exists($archivo)) {
    die("No hay usuarios registrados.");
}

$usuarios = json_decode(file_get_contents($archivo), true);

foreach ($usuarios as $u) {
    if ($u['email'] === $email && $u['password'] === $password) {
        $_SESSION['nombre'] = $u['nombre'];
        $_SESSION['email'] = $u['email'];
        header("Location: ../views/panel.php");
        exit;
    }
}

echo "Credenciales inválidas. <a href='../views/login.php'>Intentar de nuevo</a>";
