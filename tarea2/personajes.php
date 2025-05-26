<?php

include('libreria/main.php');


$obra = new Obra();

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
        echo "<a href='index.php' class btn btn-primary>Volver</a>";
        exit();
    }
}else{
    plantilla::aplicar();
    echo "<div class='text-center><div class='alert alert-danger'>No se ha encontrado ninguna obra con ese codigo</div>";
    echo "<a href='index.php' class btn btn-primary>Volver</a>";
    exit();
}

plantilla::aplicar();
?> 
<div class="row">
    <div class="col-md-4">
        <h2><?= $obra->nombre ?></h2>
        <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" height="200">
        <p><strong>Tipo:</strong> <?= Datos::Tipos_de_Obra()[$obra->tipo] ?></p>
        <p><strong>Autor:</strong> <?= $obra->autor ?></p>
        <p><strong>País:</strong> <?= $obra->pais ?></p>
        <p><strong>Descripcion:</strong> <?= $obra->descripcion ?></p>
    </div>
    <div class="col-md-8">
        <h2>Personajes</h2>
        <div class="text-end md-3">
            <a href="agregar_personaje.php>id=<?= $obra->codigo ?>" class="btn btn-primary">Agregar</i></a>
        </div>

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
                         
            </tbody>
        </table>
    </div>
</div>

