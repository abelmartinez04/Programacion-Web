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

if(isset($_GET['idx'])){
    $tmp = Dbx::get("personajes", $_GET['idx']);
    if($tmp){
        $personaje = $tmp;
    }
}else{
    $personaje = new personaje();
}
?>
<style>
    h3 {
        color: #e91e63;
        font-family: 'Comic Sans MS', cursive, sans-serif;
        text-align: center;
        margin-bottom: 30px;
        text-shadow: 1px 1px 3px #f8bbd0;
    }

    .form-label {
        color: #880e4f;
        font-weight: bold;
    }

    .form-control {
        border-radius: 20px;
        border: 2px solid #f8bbd0;
        background-color: #fff0f6;
    }

    .form-control:focus {
        border-color: #ec407a;
        box-shadow: 0 0 5px #ec407a;
    }

    .btn-primary {
        background-color: #ec407a;
        border: none;
    }

    .btn-primary:hover {
        background-color: #d81b60;
    }

    .btn-secondary {
        background-color: #ba68c8;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #ab47bc;
    }

    form {
        background-color: #ffe4ec;
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 0 15px #f8bbd0;
        max-width: 600px;
        margin: auto;
    }
</style>

<h3>Editar Personaje</h3>


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
        <select class="form-select" id="profesion" name="profesion" required>
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
    <a href="<?=base_url('modulos/personajes/lista_per.php'); ?>" class="btn btn-secondary">Cancelar</a>
</form>