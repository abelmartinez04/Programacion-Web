<?php
session_start();

if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"> 
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow custom-card"> 
                <div class="card-body">
                    <h3 class="text-center mb-4">Iniciar Sesión</h3>

                    <!-- Login manual -->
                    <form action="../controllers/validar_login.php" method="post">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <label>Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control pe-5" required>
                            <button type="button" id="togglePassword" class="btn-show-password">
                                <i id="togglePassword" class="bi bi-eye pasword-icon"></i> 
                            </button>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </form>

                    <div class="mt-2 text-end">
                        <a href="../controllers/olvide_contrasena.php">¿Olvidaste tu contraseña?</a>
                    </div>

                    <hr>

                    <!-- Opciones de autenticación externa -->
                    <div class="text-center">
                        <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
                        
                        <a href="#" class="btn btn-outline-danger w-100 mb-2">Google</a>
                        <a href="#" class="btn btn-outline-primary w-100">Microsoft</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>
