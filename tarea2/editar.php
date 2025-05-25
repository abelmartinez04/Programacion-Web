<?php

include('libreria/main.php');

$obra = new Obra();

plantilla::aplicar()
?>

<form method="POST" action="editar.php">
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select class="form-select" id="tipo" name="tipo">
        <option value="pelicula">Pelicula</option>    
        <option value="serie">Serie</option>
        <option value="libro">Libro</option>
        </select>
    </div>
</form>