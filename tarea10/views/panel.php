<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Incidencias RD</a>
    <div>
      <a href="../controllers/logout.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
    </div>
  </div>
</nav>

<div class="container py-5">
    <h2 class="text-center mb-4">Bienvenido <?= $_SESSION['nombre'] ?? 'Usuario' ?></h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3">
                <h5>Ver Mapa</h5>
                <p>Consulta las incidencias registradas en el país.</p>
                <a href="../index.php" class="btn btn-primary">Ir al mapa</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3">
                <h5>Reportar Incidencia</h5>
                <p>Simulación para el prototipo.</p>
                <a href="#" class="btn btn-success">Nuevo reporte</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3">
                <h5>Perfil</h5>
                <p>Ver y editar información de tu cuenta.</p>
                <a href="perfil.php" class="btn btn-secondary">Mi perfil</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
