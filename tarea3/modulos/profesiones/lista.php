<?php 

include('../../libreria/main.php');
define("PAGINA_ACTUAL", "profesiones");
plantilla::aplicar();

$profesiones = Dbx::list("profesiones");
// var_dump($profesiones);

?>
<style>
    h1 {
        color: #ec407a;
        text-align: center;
        margin-bottom: 30px;
        font-family: 'Comic Sans MS', cursive, sans-serif;
        text-shadow: 1px 1px 3px #f8bbd0;
    }

    .btn-success {
        background-color: #f06292;
        border: none;
        border-radius: 20px;
    }

    .btn-success:hover {
        background-color: #ec407a;
    }

    .btn-primary {
        background-color: #ba68c8;
        border: none;
        border-radius: 20px;
    }

    .btn-primary:hover {
        background-color: #ab47bc;
    }

    table {
        background-color: #fff0f6;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 15px #f8bbd0;
    }

    th {
        background-color: #f8bbd0;
        color: #880e4f;
    }

    td {
        vertical-align: middle;
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #ffe4ec;
    }
</style>

<h1>👑 Listado de Profesiones Barbie 👑</h1>

<div class="text-end mb-3">
    <a href="<?= base_url("modulos/profesiones/editar.php"); ?>" class="btn btn-success">Nueva Profesión</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($profesiones as $profesion): ?>
                <tr>
                    <td><?php echo htmlspecialchars($profesion->nombre); ?></td>
                    <td><?php echo htmlspecialchars($profesion->categoria); ?></td>
                    <td>
                        <a href="<?= base_url("modulos/profesiones/editar.php?codigo={$profesion->idx}");?>" class="btn btn-primary"><i class="bi bi-pencil-square">

                        </i>Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
    </tbody>
</table>

