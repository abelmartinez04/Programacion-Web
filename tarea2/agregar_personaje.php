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

if($_POST){
    $personaje->cedula = $_POST['cedula'];
    $personaje->foto_url = $_POST['foto_url'];
    $personaje->nombre = $_POST['nombre'];
    $personaje->apellido = $_POST['apellido'];
    $personaje->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $personaje->sexo = $_POST['sexo'];
    $personaje->habilidades = $_POST['habilidades'];
    $personaje->comida_favorita = $_POST['comida_favorita'];

    if (!isset($obra->personajes) || !is_array($obra->personajes)) {
        $obra->personajes = [];
    }

    $obra->personajes[] = $personaje;


    if(!is_dir('datos')){
        echo "Error al crear directorio, no se puede guardar la obra";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
        exit();
    }

    $ruta = 'datos/'.@$obra->codigo.'.json';

    file_put_contents($ruta, json_encode($obra));
    echo "<div class='alert alert-success'>Personaje guardado correctamente</div>";
    echo "<a href='personajes.php?id=".$obra->codigo."' class='btn btn-primary'>Volver</a>";
    exit();
}

?> 
<!--Resumen de la obra -->

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
        <h2>Datos del personaje</h2>
        <form action="agregar_personaje.php?id=<?= $obra->codigo ?>" method="POST" enctype="multipart/form-data">
        <!--Cedula del personaje -->
        <div class="mb-3">
            <label for="cedula" class="form-label">Cedula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" value="<?= $personaje->cedula ?>" required>
        </div>
        <!-- foto del personaje -->
         <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="text" class="form-control" id="foto_url" name="foto_url" accept=".jpg, .jpeg, .png, .gif" required>
        </div>
        <!-- nombre del personaje -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $personaje->nombre ?>" required>
        </div>
        <!-- apellido del personaje -->
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $personaje->apellido ?>" required>
        </div>
        <!-- fecha de nacimiento del personaje -->
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?=$personaje->fecha_nacimiento?>" required>
        </div>
        <!-- sexo del personaje -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Sexo</label>
            <select class="form-control" id="sexo" name="sexo">
                <option value="">Seleccione</option>
                <option value="Masculino" <?= ($personaje->sexo == 'masculino') ? 'selected' : '' ?>>Masculino</option>
                <option value="femenino" <?= ($personaje->sexo == 'femenino') ? 'selected' : '' ?>>Femenino</option>
            </select> 
        </div>

        <!-- habilidades del personaje -->
        <div class="mb-3">
            <label for="habilidades" class="form-label">Habilidades</label>
            <textarea class="form-control" id="habilidades" name="habilidades"><?=$personaje->habilidades?></textarea>
        </div>

        <!-- comida favorita del personaje -->

        <div class="mb-3">
            <label for="comida_favorita" class="form-label">Comida favorita</label>
            <input type="text" class="form-control" id="comida_favorita" name="comida_favorita" value="<?=$personaje->comida_favorita?>" required>
        </div>

        <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?id=<?=$obra->codigo ?>" class="btn btn-secondary">Cancelar</a>
        </div>
        </form>
    </div>
</div>
<php