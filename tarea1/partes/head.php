<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

            #tarea1 {
                width: 90%;
                max-width: 900px;
                margin: 80px auto 40px auto; /* arriba | lados | abajo */
                padding: 30px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                color: #333;
            }

            p {
                text-align: center;
                color: #666;
            }

            #divMenu ul {
                list-style: none;
                padding: 0;
                display: flex;
                justify-content: center;
                gap: 20px;
                margin: 30px 0;
            }

            #divMenu li {
                display: inline;
            }

            #divMenu a {
                text-decoration: none;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            #divMenu a:hover {
                background-color: #45a049;
                text-decoration: underline;
            }

            #divContenido ul {
                padding-left: 20px;
                color: #333;
            }

            #divContenido li {
                margin-bottom: 10px;
            }

            <div id="divContenido"></div>

            #divFooter {
                text-align: center;
                margin-top: 40px;
                font-size: 0.9em;
                color: #999;
            }

            hr {
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .breadcrumb {
                margin: 15px 0;
                font-size: 0.9em;
            }
            .breadcrumb a {
                text-decoration: none;
                color: #4CAF50;
                display: inline-flex;
                align-items: center;
            }
            .breadcrumb a i {
                margin-right: 4px;
            }
            .breadcrumb span {
                margin: 0 5px;
                color: #999;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            table, th, td {
                border: 1px solid #ccc;
            }

            th {
                background-color: #f4f4f4;
                text-align: left;
                padding: 10px;
                color: #333;
            }

            td {
                padding: 10px;
                color: #555;
            }

            h3 {
                margin-top: 20px;
                padding: 15px;
                border-radius: 5px;
                background-color: #e7f4e4;
                color: #2d7a2d;
                border: 1px solid #b6dfb6;
                text-align: center;
            }

        </style>
    </head>
    <body>
        </a>
        <div id="tarea1">
            <div class="breadcrumb">
            <a href="index.php"><i class="bi bi-house-door-fill"></i>Inicio</a>
            <span>></span>
            <span>
            <?php
            $archivo = basename($_SERVER['PHP_SELF'], ".php"); // obtiene el nombre del archivo sin ".php"

            // Opcional: reemplazar guiones bajos por espacios y capitalizar
            $nombrePagina = ucwords(str_replace("_", " ", $archivo));

            echo $nombrePagina;
            ?>
        </span>
            </div>

            <!-- <div>
                <h1>Tarea 1</h1>
                <p>Este es un pequeño menu para la tarea 1 de la materia Programacion Web</p>
            </div> -->
            <hr>

            <div id="divMenu">
                <ul>
                    <li>
                        <a href="mi_tarjeta.php">Tarjeta</a>
                    </li>
                    <li>
                        <a href="calculadora.php">Calculadora</a>
                    </li>
                    <li>
                        <a href="adivina.php">Adivina</a>
                    </li>
                    <li>
                        <a href="acercade.php">Acerca de</a>
                    </li>
                </ul>
            </div>
            <div id="divContenido"></div>