
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Principal - La Rubia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <header class="bg-success bg-opacity-50 text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Sistema de Ventas - La Rubia</h3>
            <div>
                <span class="me-3">Usuario: <strong><?= $_SESSION['usuario'] ?></strong></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-6 mb-4">
                <a href="factura.php" class="btn btn-primary w-100 py-4">
                    🧾 Registrar Nueva Factura
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a href="reporte.php" class="btn btn-success w-100 py-4">
                    📊 Ver Reporte Diario
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-success bg-opacity-50 text-white text-center py-3 mt-5">
        Bienvenido a La Rubia &copy; <?= date("Y") ?>
    </footer>
</body>
</html>
