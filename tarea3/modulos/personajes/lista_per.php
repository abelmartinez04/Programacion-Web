<?php 

include('../../libreria/main.php');
define("PAGINA_ACTUAL", "personajes");
plantilla::aplicar();


$personajes = Dbx::list("personajes");
?>

<h3>Listado de personajes</h3>

<div class="text-end mb-3">
    <a href="<?= base_url("modulos/personajes/editar.php"); ?>" class="btn btn-success">Nuevo personaje</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Genero</th>
            <th>Profesion</th>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($personajes as $personaje): ?>
            <tr>
                <td><?php echo htmlspecialchars($personaje->nombre); ?></td>
                <td><?php echo htmlspecialchars($personaje->edad()); ?></td>
                <td><?php echo htmlspecialchars($personaje->nivel_experiencia); ?></td>
                <td><?php echo htmlspecialchars($personaje->profesion); ?></td>
                <td>
                    <a href="<?= base_url("modulos/personajes/editar.php?id=" . $personaje->id); ?>" class="btn btn-primary">Editar</a>
                    <a href="<?= base_url("modulos/personajes/eliminar.php?id=" . $personaje->id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
    
        <?php endforeach; ?>
    </tbody>
    </thead>
</table>