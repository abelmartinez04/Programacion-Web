<?php 

include('../../libreria/main.php');
define("PAGINA_ACTUAL", "profesiones.php");
plantilla::aplicar();

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
                        <a href="editar_profesion.php?codigo=<?php echo $profesion['id']; ?>">Editar</a>
                        <a href="eliminar_profesion.php?id=<?php echo $profesion['id']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
    </tbody>
</table>