<?php
require 'conexion.php';
require 'libreria/plantilla.php';

$titulo = "Listado de Personajes";

    

?>

<h1 class="mb-4">Lista de Personajes</h1>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Color</th>
            <th>Tipo</th>
            <th>Nivel</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $personajes = $conexion->query("SELECT * FROM personajes ");
    while($p = $personajes->fetch_object()){ ?>
        <tr>
            <td><img src="<?= $p->foto ?>" width="50" class="img-thumbnail"></td>
            <td><?= htmlspecialchars($p->nombre) ?></td>
            <td><?= htmlspecialchars($p->color) ?></td>
            <td><?= htmlspecialchars($p->tipo) ?></td>
            <td><?= htmlspecialchars($p->nivel) ?></td>
            <td>
                <a href="editar.php?id=<?= $p->id ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="eliminar.php?id=<?= $p->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                <a href="descargar_pdf.php?id=<?= $p->id ?>" class="btn btn-sm btn-secondary">PDF</a>
            </td>
        </tr>
    <?php }
    ?>

    </tbody>
</table>

