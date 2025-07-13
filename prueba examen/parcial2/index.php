<!-- Abel Martinez - 2024-0227 -->
<?php 
include "models/conexion.php";
require 'libreria/plantilla.php';
plantilla::aplicar();
?>

<h1 class="text-primary mb-4">Registros de Visitas</h1>

<div class="mb-3 text-end">
    <a href="agregar.php" class="btn btn-primary"> Nueva Visita</a>
</div>

<!-- Tabla para vista de las visitas -->
<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Correo Electronico</th>
            <th></th> 
        </tr>
    </thead>
    <tbody>
        <?php
        $personajes = $conexion->query("SELECT * FROM registros");
        while ($p = $personajes->fetch_object()) { ?>
            <tr>
                <td><?= htmlspecialchars($p->nombre) ?></td>
                <td><?= htmlspecialchars($p->apellido) ?></td>
                <td><?= htmlspecialchars($p->telefono) ?></td>
                <td><?= htmlspecialchars($p->correo_electronico) ?></td>
                <td>
                    <a href="editar.php?id=<?= $p->id ?>" class="btn btn-outline-warning">Editar</a>
                    <a href="eliminar.php?id=<?= $p->id ?>" class="btn btn-outline-danger">Eliminar</a>
                </td>
            </tr>
       <?php } ?>
    </tbody>
</table>