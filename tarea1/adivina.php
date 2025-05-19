<?php require('partes/head.php'); ?>


<div id="divContenido">
    <h3>Adivina el número del 1 al 5</h3>

    <form method="GET" action="">
      <input type="number" name="guessing" style="width: 400px;" required id="numero" min="1" max="5" placeholder="Escribe un número del 1 al 5" 
      value="<?= isset($_GET['guessing']) ? $_GET['guessing'] : '';?>"/>
      <button type="submit">Enviar</button>
    </form>

    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }

        input[type="number"] {
            width: 300px;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="number"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        button {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .mensaje-correcto {
            background-color: #e7f4e4;
            color: #2d7a2d;
            border: 1px solid #b6dfb6;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .mensaje-error {
            background-color: #fdecea;
            color: #b72c2c;
            border: 1px solid #f5c6cb;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
    </style>

<?php
    if (isset($_GET['guessing'])) { 
        $numero = $_GET['guessing'];
        $aleatorio = rand(1, 5);
        if ($numero == $aleatorio) {
            echo "<div class='mensaje-correcto'>🎉 ¡Felicidades! Has adivinado el número $aleatorio.</div>";
        } else {
            echo "<div class='mensaje-error'>❌ Lo siento, el número era: $aleatorio.</div>";
        }
    }
?>

<?php require('partes/bottom.php'); ?>