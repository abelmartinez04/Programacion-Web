create database empresa;

use empresa

create table registros(
	id INT AUTO_INCREMENT PRIMARY KEY,
    telefono VARCHAR(20),
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    correo_electronico VARCHAR(100)
);

select * from registros