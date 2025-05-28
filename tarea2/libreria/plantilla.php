<?php 
class plantilla{

    public static $instancia = null;
    public static function aplicar() {
        if (self::$instancia == null) {
            self::$instancia = new plantilla();
        }
        return self::$instancia;
    }

    public function __construct()   {

        ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lo que he visto</title>
        <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/558/558585.png" />
        
        <!-- Bootsrap CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- FontAwesome para íconos -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        
        <style>
            body {
                background: #f0f2f5;
                font-family: 'Segoe UI', sans-serif;
            }

            h1 {
                font-size: 2.5rem;
                color: #0d6efd;
            }

            .container {
                background: #fff;
                padding: 30px;
                margin-top: 30px;
                border-radius: 12px;
                box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            }

            .table thead {
                background-color:rgb(54, 54, 54);
                color: white;
            }

            .btn i {
                margin-right: 5px;
            }

            .text-center hr {
                margin-top: 50px;
            }
        </style>
    </head>

    <body>
        <div class="container bg-white p-4 rounded shadow-sm">
            <a href="index.php">
            <h1 class="mt-3">Lo que he visto</h1>
            </a>
            <p>Listado de peliculas y series en la que he invertido mi tiempo⌛</p>


        <div style="min-height: 500px;">
<?php 
    }

    public function __destruct() {
        ?>
        <div class="text-center">
            <hr>
            Derechos reservados &copy; <?= date('Y') ?> - Lo que he visto
       </div>
    
    </div>
    

</body>

</html>

<?php
    }
}
