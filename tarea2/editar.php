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
    }
}

if($_POST){
    $obra->codigo = $_POST['codigo'] ?? '';
    $obra->foto_url = $_POST['foto_url'];
    $obra->tipo = $_POST['tipo'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->autor = $_POST['autor'];

    if(!is_dir('datos')){
        mkdir('datos');
    }

    if(!is_dir('datos')){
        plantilla::aplicar();
        echo "Error al crear directorio, no se puede guardar la obra";
        echo "<a href='index.php' class btn btn-primary>Volver</a>";
        exit();
    }

    $ruta = 'datos/'.@$obra->codigo.'.json';

    $json = json_encode($obra);

    file_put_contents($ruta, $json);

    

    plantilla::aplicar();
    echo "<div class='alert alert-success'>La obra ha sido guardada correctamente</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}



plantilla::aplicar()
?>
<h2 class="text-primary mb-4"><i class="fas fa-pen"></i> <?= isset($_GET['id']) ? 'Editar' : 'Agregar' ?> Obra</h2>
<div class="card shadow-sm border-0">
    <div class="card-body"></div>
        <form method="POST" action="editar.php">
            <!--codigo de la obra -->
            <div class="mb-3">
                <label for="codigo" class="form-label">Codigo</label>
                <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $obra->codigo ?>" required>
            </div>

            <!--foto de la obra -->
            <div class="mb-3">
                <label for="foto_url" class="form-label">Foto</label>
                <input type="text" class="form-control" id="foto_url" name="foto_url" value="<?= $obra->foto_url ?>" required>
            </div>

            <!--tipo de la obra -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" id="tipo" name="tipo">
                    <option value="">Seleccione</option>    
                    <?php 
                        $selected = $obra->tipo;
                        foreach(Datos::Tipos_de_Obra() as $key => $value){
                            $isSelected = ($key == $selected) ? 'selected' : '';
                            echo "<option value='$key' $isSelected>$value</option>";
                        }
                    ?>
                </select>
            </div>

            <!--nombre de la obra -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $obra->nombre ?>" required>
            </div>

            <!--descripcion de la obra -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?= $obra->descripcion ?></textarea>
            </div>

            <!--pais de la obra -->
            <div class="mb-3">
                <label for="pais" class="form-label">País</label>
                <input type="text" class="form-control" id="pais" name="pais" value="<?= $obra->pais ?>" required>
            </div>

            <!--autor de la obra -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" value="<?= $obra->autor ?>" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="index.php" class="btn btn-secondary px-4">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>