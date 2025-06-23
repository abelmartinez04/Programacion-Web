<!-- Abel Martinez - 2024-0227 -->

<?php
include 'plantilla.php';
ob_start();
?>

<div class="text-center">
    <img src="assets/img/mi_foto.png" class="rounded-circle shadow" width="150" alt="Foto de Abel Martínez">
    <h1 class="mt-3">Abel Martínez</h1>
    <p class="lead">Bienvenido a mi portal interactivo con APIs desarrolladas en PHP 🚀</p>
</div>

<hr>

<div class="row text-center mt-4">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Explora APIs</h5>
                <p class="card-text">Consulta información en tiempo real: clima, monedas, países y más.</p>
                <a href="api/genero.php" class="btn btn-primary">Comenzar</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Conoce el Proyecto</h5>
                <p class="card-text">Descubre qué herramientas usamos y cómo fue desarrollado el portal.</p>
                <a href="acerca.php" class="btn btn-secondary">Ver más</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">GitHub del Proyecto</h5>
                <p class="card-text">Revisa el código fuente, historial de cambios y despliegue del portal.</p>
                <a href="https://github.com/abelmartinez04/Programacion-Web/tree/main/Tarea%205" class="btn btn-dark" target="_blank">Ir al repositorio</a>
            </div>
        </div>
    </div>
</div>

<?php
$contenido = ob_get_clean();
mostrarPagina("Inicio", $contenido);
?>
