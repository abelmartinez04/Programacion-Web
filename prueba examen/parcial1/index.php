<!-- Abel Martinez - 2024-0227 -->

<?php 
$visitas = [];
if(is_dir('datos')){
    foreach(glob('datos/*.json') as $archivo){
        $json = file_get_contents($archivo);
        $visita = json_decode($json);
        if($visita){
            $visitas[] = $visita;
        }
    }
}

require('libreria/main.php');
plantilla::aplicar();
?>

<h2 class="text-primary mb-4"><i class="fas fa-tooth"></i> Visitas al consultorio</h2>

<div class="mb-3 text-end">
    <a href="agregar.php" class="btn btn-primary"> Nueva Visita</a>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cedula</th>
            <th>Edad</th>
            <th>Motivo</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($visitas as $v): ?>
        <tr>
            <td><?= $v->nombre ?> <?= $v->apellido ?></td>
            <td><?= $v->cedula ?></td>
            <td><?= $v->edad ?></td>
            <td><?= $v->motivo ?></td>
            <td><?= $v->fecha_hora ?></td>
            <td>
                <a href="agregar.php?id=<?= $v->cedula ?>" class='btn btn-outline-warning'>Editar</a>
                <a href="eliminar.php?id=<?= $v->cedula ?>" class='btn btn-outline-danger'>Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($visitas)): ?>
            <tr>
                <td colspan="6" class="text-center">No hay registros</td>
            </tr>
        <?php endif; ?> 
    </tbody>
</table>
