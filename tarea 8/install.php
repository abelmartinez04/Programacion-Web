<?php
$conexion = new mysqli("localhost", "root", "Mybdo*", "");

$conexion->query("CREATE DATABASE IF NOT EXISTS la_rubia");
$conexion->select_db("la_rubia");


$conexion->query("CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    clave VARCHAR(255) NOT NULL
)");

$claveHash = password_hash("tareafacil25", PASSWORD_DEFAULT);
$conexion->query("INSERT INTO usuarios (usuario, clave) VALUES ('demo', '$claveHash')");

$conexion->query("CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) UNIQUE,
    nombre VARCHAR(100)
)");

$conexion->query("CREATE TABLE IF NOT EXISTS facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_recibo VARCHAR(20),
    fecha DATE,
    cliente_id INT,
    comentario TEXT,
    total DECIMAL(10,2),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
)");

$conexion->query("CREATE TABLE IF NOT EXISTS factura_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    factura_id INT,
    articulo VARCHAR(100),
    cantidad INT,
    precio DECIMAL(10,2),
    total DECIMAL(10,2),
    FOREIGN KEY (factura_id) REFERENCES facturas(id)
)");

$conexion->query("CREATE TABLE IF NOT EXISTS articulos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL
)");

$conexion->query("INSERT INTO articulos (nombre, precio) VALUES
    ('Refresco', 20.00),
    ('Empanada', 35.00),
    ('Jugo Natural', 60.00),
    ('Lays', 25.00),
    ('Doritos', 25.00),
    ('Agua', 15.00),
    ('Sandwich', 55.00),
    ('Galleta', 20.00),
    ('Café', 30.00)
");


echo "✅ Instalación completada correctamente. Base de datos creada.";
?>
