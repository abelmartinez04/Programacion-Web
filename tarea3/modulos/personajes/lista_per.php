<?php 

include('../../libreria/main.php');
define("PAGINA_ACTUAL", "personajes");
plantilla::aplicar();


$personajes = Dbx::list("personajes");
?>

<style>
    h3 {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        color: #e91e63;
        text-align: center;
        margin-bottom: 30px;
        text-shadow: 1px 1px 3px #f8bbd0;
    }

    .btn-success {
        background-color: #ec407a;
        border: none;
    }

    .btn-success:hover {
        background-color: #d81b60;
    }

    .btn-primary {
        background-color: #ba68c8;
        border: none;
    }

    .btn-primary:hover {
        background-color: #ab47bc;
    }

    .btn-danger {
        background-color: #f06292;
        border: none;
    }

    .btn-danger:hover {
        background-color: #e91e63;
    }

    .table th {
        background-color: #f8bbd0;
        color: #880e4f;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .table-striped > tbody > tr:nth-child(odd) {
        background-color: #fce4ec;
    }

    .table-striped > tbody > tr:nth-child(even) {
        background-color: #f8bbd0;
    }
</style>

<h3>🌟 Listado de Personajes Barbie 🌟</h3>

<h3>Listado de personajes</h3>

<div class="text-end mb-3">
    <a href="<?= base_url("modulos/personajes/editar.php"); ?>" class="btn btn-success">➕ Nuevo personaje</a>
</div>

<table class="table table-striped shadow rounded">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Experiencia</th>
            <th>Codigo</th>
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
                    <a href="<?= base_url("modulos/personajes/editar.php?idx={$personaje->idx}"); ?>" class="btn btn-primary">Editar</a>
                    <a href="<?= base_url("modulos/personajes/eliminar.php?idx={$personaje->idx}"); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
    
        <?php endforeach; ?>
    </tbody>
    </thead>
</table>