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
            <title>🌸 Mundo Barbie 🌸</title>
            <!-- Favicon estilo Barbie -->
            <!-- <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/3468/3468360.png"> -->

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Google Fonts - estilo cursivo y juguetón -->
            <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

            <!-- Estilos Barbie -->
            <style>
                body {
                    background: linear-gradient(to right, #ffd6f3, #ffe3f9);
                    font-family: 'Roboto', sans-serif;
                    color: #5a005a;
                }

                h1, h2, h3, .navbar-brand {
                    font-family: 'Pacifico', cursive;
                    color: #e91e63;
                }

                .nav-tabs .nav-link {
                    background-color: #f8bbd0;
                    color: white;
                    font-weight: bold;
                    border-radius: 10px;
                    margin: 0 5px;
                    transition: 0.3s;
                }

                .nav-tabs .nav-link.active, .nav-tabs .nav-link:hover {
                    background-color: #ec407a;
                    color: white;
                }

                .container {
                    background-color: white;
                    border-radius: 20px;
                    padding: 20px;
                    box-shadow: 0 8px 16px rgba(233, 30, 99, 0.2);
                    margin-top: 30px;
                    margin-bottom: 30px;
                }

                .footer {
                    text-align: center;
                    padding: 20px;
                    color: #880e4f;
                }

                a {
                    text-decoration: none;
                }

                .divMenu {
                    margin-bottom: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="text-center mb-4">
                    <h1>🌟 Mundo Barbie 🌟</h1>
                    <p>¡Bienvenid@ al universo donde todo es posible!</p>
                </div>
                <div class="divMenu text-center">
                    <!-- Aqui va el menu -->
                    <ul class="nav nav-tabs justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'inicio'?'active':''; ?>" aria-current="page" href="<?=base_url(); ?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'personajes'?'active':''; ?>" href="<?=base_url('modulos/personajes/lista_per.php'); ?>">Personajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'profesiones'?'active':''; ?>" href="<?=base_url('modulos/profesiones/lista.php'); ?>">Profesiones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'estadisticas'?'active':''; ?>" href="<?=base_url('modulos/reportes/menu.php'); ?>">Estadísticas</a>
                        </li>
                    </ul>
                </div>
                <div class="contenido" style="min-height: 400px;">
                

        <?php
    }

    function __destruct(){
        ?> 
        </div>
        <div>
                <div class="footer">
                        <hr>
                        <p> © 2025 - Mundo Barbie✨</p>
                    </div>
                </div>
        </body>
        </html>
        
        <?php
        
    }
}

?>