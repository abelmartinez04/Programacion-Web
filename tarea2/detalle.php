<?php

include('libreria/main.php');


$obra = new Obra();

$personaje = new Personaje();



// var_dump('datos');
if(isset($_GET['id'])){
    $ruta = 'datos/'.$_GET['id'].'.json';
    if(is_file($ruta)){
        $json = file_get_contents($ruta);
        $obra = json_decode($json);
        // $obra = (object) $obra;
    }else {
        plantilla::aplicar();
        echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
        exit();
    }
}else{
    plantilla::aplicar();
    echo "<div class='text-center><div class='alert alert-danger'>No se ha encontrado ninguna obra con ese codigo</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}

plantilla::aplicar();

?>

<div class="text-end">
    <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
</div>

<div class="row">
    <div class="col-md-12">
        <h2><?= $obra->nombre ?></h2>
        <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" height="200">
        <p><strong>Tipo:</strong> <?= Datos::Tipos_de_Obra()[$obra->tipo] ?></p>
        <p><strong>Autor:</strong> <?= $obra->autor ?></p>
        <p><strong>País:</strong> <?= $obra->pais ?></p>
        <p><strong>Descripcion:</strong> <?= $obra->descripcion ?></p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Personajes</h2>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de nacimiento</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($obra->personajes as $personaje){
                        echo "<tr>";
                        echo "<td><img src='".$personaje->foto_url."' alt='".$personaje->nombre."' height='100'></td>";
                        echo "<td>".$personaje->nombre."</td>";
                        echo "<td>".$personaje->apellido."</td>";
                        echo "<td>".$personaje->fecha_nacimiento."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>