<?php 
include('libreria/main.php');

$visita = new stdClass();

if(isset($_GET['id'])){
    $ruta = 'datos/'.$_GET['id'].'.json';
    if(is_file($ruta)){
        $json = file_get_contents($ruta);
        $visita = json_decode($json);
    }
}

if($_POST){
    $visita->nombre = $_POST['nombre'];
    $visita->apellido = $_POST['apellido'];
    $visita->cedula = $_POST['cedula'];
    $visita->edad = $_POST['edad'];
    $visita->motivo = $_POST['motivo'];
    if (empty($visita->fecha_hora)) {
        $visita->fecha_hora = date("Y-m-d H:i:s");
    }


    if(!is_dir('datos')){
        mkdir('datos');
    }

    $archivo = $visita->cedula.'.json';
    $json = json_encode($visita, JSON_PRETTY_PRINT);
    file_put_contents('datos/'.$archivo, $json);
    
    plantilla::aplicar();
    echo "<div class='alert alert-success'>✅Visita guardada exitosamente</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}


plantilla::aplicar();

?>

<h2 class="text-primary mb-4"><i class="fas fa-tooth"></i> <?=isset($_GET['id']) ? 'Editar' : 'Registrar' ?> Visita</h2>
<form method="POST" action="agregar.php<?= isset($_GET['id']) ? '?id='.$_GET['id'] : '' ?>">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $visita->nombre  ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $visita->apellido  ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label for="cedula" class="form-label">Cedula</label>
        <input type="text" class="form-control" id="cedula" name="cedula" value="<?= $visita->cedula  ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label for="edad" class="form-label">Edad</label>
        <input type="number" class="form-control" id="edad" name="edad" value="<?= $visita->edad  ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label for="motivo" class="form-label">Motivo</label>
        <select name="motivo" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="Limpieza" <?= ($visita->motivo ?? '') == 'Limpieza' ? 'selected' : '' ?>>Limpieza</option>
            <option value="Caries" <?= ($visita->motivo ?? '') == 'Caries' ? 'selected' : '' ?>>Caries</option>
            <option value="Dolor" <?= ($visita->motivo ?? '') == 'Dolor' ? 'selected' : '' ?>>Dolor</option>
            <option value="Chequeo" <?= ($visita->motivo ?? '') == 'Chequeo' ? 'selected' : '' ?>>Chequeo</option>
        </select>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-success px-4">
            <i class="fas fa-save"></i> Guardar
        </button>
        <a href="index.php" class="btn btn-secondary px-4">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>
    </div>

</form>