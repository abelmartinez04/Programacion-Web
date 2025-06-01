<?php

class Plantilla{
    static $instancia = null;
    public static function aplicar(){
        if (self::$instancia == null) {
            self::$instancia = new Plantilla();
        }
        return self::$instancia;
    }
    function __construct(){
        $pagina_actual = (defined('PAGINA_ACTUAL') ? PAGINA_ACTUAL : "inicio");
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mundo Barbie</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <div class="container">
                <div>
                    <h1>Mundo Barbie</h1>
                </div>
                <div class="divMenu">
                    <!-- Aqui va el menu -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'inicio'?'active':''; ?>" aria-current="page" href="<?=base_url(); ?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'personajes'?'active':''; ?>" href="personajes.php">Personajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'profesiones'?'active':''; ?>" href="<?=base_url('modulos/profesiones/lista.php'); ?>">Profesiones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'estadisticas'?'active':''; ?>" href="estadisticas.php">Estadísticas</a>
                        </li>
                    </ul>
                </div>
                <div class="contenido" style="min-height: 200px;">
                

        <?php
    }

    function __destruct(){
        ?> 
        </div>
        <div>
                <div class="footer">
                        <hr>
                        <p> © 2025 - Mundo Barbie</p>
                    </div>
                </div>
        </body>
        </html>
        
        <?php
        
    }
}

?>