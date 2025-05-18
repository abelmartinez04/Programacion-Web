<?php 
$tituloPagina = "Calculadora";
require('partes/head.php'); 

?>
<style>
    form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        h3 {
            text-align: center;
            color: #333;
        }
</style>

<form method="GET" action="calculadora_resultado.php">
    <h2>Calculadora</h2>
    <div class="inputx">
        <label>Número 1:</label><input required type="number" name="num1"/>
    </div>
    
    <div class="inputx">
        <label>Número 2:</label><input required type="number" name="num2"/>
    </div>

    <div class="inputx">
        <label>Operación:</label>
        <select name="operacion" required>
            <option value="">Selecciona una operación</option>
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select><br><br>
    </div>
    
    <div class="inputx">
        <button type="submit">Calcular</button>
    </div>
    
</form>

<?php require('partes/bottom.php'); ?>