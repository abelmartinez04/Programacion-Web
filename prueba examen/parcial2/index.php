<!-- Abel Martinez - 2024-0227 -->
<?php 
include "models/conexion.php";
require 'libreria/plantilla.php';
plantilla::aplicar();
?>

<h1 class="text-primary mb-4">Registros de las visitas</h1>

<div class="mb-3 text-end">
    <a href="agregar.php" class="btn btn-primary">Agregar</a>
</div>

<!-- Tabla donde se ven las visitas -->
 <table class="table table-bordered table-striped table-hover">
    <thead class=table-dark>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $visitas = $conexion->query("SELECT * FROM registros");
        while ($v = $visitas->fetch_object()) { ?>
            <tr>
                <td><?= htmlspecialchars($v->nombre) ?></td>
                <td><?= htmlspecialchars($v->apellido) ?></td>
                <td><?= htmlspecialchars($v->telefono) ?></td>
                <td><?= htmlspecialchars($v->correo_electronico) ?></td>
                <td>
                    <a href="editar.php?id=<?= $v->id ?>" class="btn btn-outline-warning">Editar</a>
                    <a href="eliminar.php?id=<?= $v->id ?>" class="btn btn-outline-danger">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
 </table>