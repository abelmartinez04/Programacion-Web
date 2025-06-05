<?php
include('../../libreria/main.php');
define("PAGINA_ACTUAL", "profesiones");

if($_POST){
    $profesion = new profesion($_POST);
    Dbx::save("profesiones", $profesion);
    header("Location: ".base_url("modulos/profesiones/lista.php"));
    exit();
}

plantilla::aplicar();

$profesion = new profesion();

if(isset($_GET['codigo'])){
    $tmp = Dbx::get("profesiones", $_GET['codigo']);
    if($tmp){
        $profesion = $tmp;
    }
   
}else{
    $profesion = new profesion();
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

<h3>💼 Editar Profesión Barbie 💼</h3>

<h3>Editar profesión</h3>

<form method="POST" action="<?=$_SERVER['REQUEST_URI'] ?>">
    <div class="mb-3">
        <label for="codigo" class="form-label">Codigo</label>
        <input type="text" class="form-control" id="idx" name="idx" value="<?= htmlspecialchars($profesion->idx); ?>" readonly>
    </div>
    
    <div class="mb-3">
        <label for="descripcion" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($profesion->nombre); ?>" required>
    </div>

    <div class="mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <input type="text" class="form-control" id="categoria" name="categoria" value="<?= htmlspecialchars($profesion->categoria); ?>" required>
    </div>

    <div class="mb-3">
        <label for="salario_mensual" class="form-label">Salario mensual</label>
        <input type="number" class="form-control" id="salario_mensual" name="salario_mensual" value="<?= htmlspecialchars($profesion->salario_mensual); ?>" required>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?php base_url('modulos/profesiones/lista.php'); ?>" class="btn btn-secondary">Cancelar</a>
</form>
