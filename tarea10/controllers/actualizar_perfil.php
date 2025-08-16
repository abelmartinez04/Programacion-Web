<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

$nombre = trim($data['nombre']);
$email = trim($data['email']);
$telefono = trim($data['telefono']);
$nuevaPassword = trim($data['nuevaPassword']);

$usuarios = json_decode(file_get_contents('../data/usuarios.json'), true);

// Actualiza usuario
foreach($usuarios as &$u){
    if($u['email'] === $_SESSION['email']){
        $u['nombre'] = $nombre;
        $u['email'] = $email;
        $u['telefono'] = $telefono;
        if($nuevaPassword) $u['password'] = $nuevaPassword;
        break;
    }
}

file_put_contents('../data/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));

// Actualiza sesión
$_SESSION['nombre'] = $nombre;
$_SESSION['email'] = $email;
$_SESSION['telefono'] = $telefono;

echo 'ok';
