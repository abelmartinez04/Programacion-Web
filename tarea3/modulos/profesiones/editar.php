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

<h3>Editar profesión</h3>

<form method="POST" action="<?=$_SERVER['REQUEST_URI'] ?>">
    <div class="mb-3">
        <label for="codigo" class="form-label">Codigo</label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="<?= htmlspecialchars($profesion->codigo); ?>" >
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
