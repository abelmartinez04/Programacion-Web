<?php 

class Plantilla{
    public static $instancia = null;
    public static function aplicar(){
        if (self::$instancia == null) {
            self::$instancia = new Plantilla();
        }
        return self::$instancia;
    }

    public function __construct(){
        ?> 
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dentista</title>

            <!-- En tu sección <head> -->
            <link rel="icon" type="image/svg+xml" href="favicon-dental.svg">


            <!-- Bootsrap CSS-->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <div class="container bg-white p-4 rounded shadow-sm">
                <a href="index.php" style="text-decoration:none">
                    <h1 class="mt-3"><i class="fas fa-tooth"></i> Consultorio Dental</h1>
                </a>
                <p>Registro de visitas de pacientes🦷</p>
                <div style="min-height: 500px;">

        <?php
    }

    public function __destruct(){
        ?> 
        </div>
        <div class="text-center">
            <hr>
            Derechos reservados &copy; 2025 - Consultorio Dental
        </div>
    </div>
</body>
</html>
        <?php
    }
}

?>