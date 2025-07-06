create database gestion_personajes
use gestion_personajes

CREATE TABLE personajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    color VARCHAR(50),
    tipo VARCHAR(50),
    nivel INT,
    foto VARCHAR(255)
);


select * from personajes