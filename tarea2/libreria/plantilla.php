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
        <!-- Bootsrap CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body class="container">
        <div>
            <h1 class="mt-3">Lo que he visto</h1>
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
