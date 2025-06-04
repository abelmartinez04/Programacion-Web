<?php 
include('../../libreria/main.php');
define("PAGINA_ACTUAL", "personajes");

if($_POST){
    $personaje = new personaje($_POST);
    Dbx::save("personajes", $personaje);
    header("Location: ".base_url("modulos/personajes/lista_per.php"));
    exit();
}

plantilla::aplicar();

$personaje = new personaje();

if(isset($_GET['id'])){
    $tmp = Dbx::get("personajes", $_GET['id']);
    if($tmp){
        $personaje = $tmp;
    }
}else{
    $personaje = new personaje();
}
?>

<h3>Editar personaje</h3>

<form method="POST" action="<?=$_SERVER['REQUEST_URI'] ?>">
    <div class="mb-3">
        <label for="codigo" class="form-label">Codigo</label>
        <input type="text" class="form-control" id="idx" name="idx" value="<?= htmlspecialchars($personaje->idx); ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="identificacion" class="form-label">Identificacion</label>
        <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?= htmlspecialchars($personaje->identificacion); ?>" required>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($personaje->nombre); ?>" required>
    </div>

    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($personaje->apellido); ?>" required>
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($personaje->fecha_nacimiento); ?>" required>
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="text" class="form-control" id="foto" name="foto" value="<?= htmlspecialchars($personaje->foto); ?>" required>
    </div>

    <div class="mb-3">
        <label for="profesion" class="form-label">profesion</label>
        <select class="form-select" id="profesion" name="profesion">
            <option value="">Seleccione una profesion</option>    
            <?php
                $profesiones = Dbx::list("profesiones");
                foreach($profesiones as $prof): ?>
                    <option value="<?= htmlspecialchars($prof->idx); ?>" <?= $personaje->profesion == $prof->idx ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($prof->nombre); ?>
                    </option>
                <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="nivel_experiencia" class="form-label">Nivel de experiencia</label>
        <input type="number" class="form-control" id="nivel_experiencia" name="nivel_experiencia" value="<?= htmlspecialchars($personaje->nivel_experiencia); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?php base_url('modulos/personajes/lista_per.php'); ?>" class="btn btn-secondary">Cancelar</a>
</form>