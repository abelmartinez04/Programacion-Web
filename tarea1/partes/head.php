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
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        </style>
    </head>
    <body>
        <div id="tarea1">
            <div>
                <h1>Tarea 1</h1>
                <p>Este es un pequeño menu para la tarea 1 de la materia Programacion Web</p>
            </div>
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