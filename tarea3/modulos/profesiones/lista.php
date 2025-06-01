<?php 

include('../../libreria/main.php');
define("PAGINA_ACTUAL", "profesiones.php");
plantilla::aplicar();

$profesiones = Dbx::list("profesiones");

?>
<h1>Listado de profesiones</h1>

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
                    <td><?php echo htmlspecialchars($profesion['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($profesion['catergoria']); ?></td>
                    <td>
                        <a href="<?= base_url("modulos/profesiones/editar_profesion.php?codigo={$profesion->codigo}");?>" class="btn btn-primary"></a><i class="bi bi-pencil-square"></i>Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
    </tbody>
</table>