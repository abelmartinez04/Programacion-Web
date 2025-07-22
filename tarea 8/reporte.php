<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    
    $stmt = $conn->prepare("DELETE FROM factura_detalles WHERE factura_id = ?");
    $stmt->bind_param("i", $idEliminar);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM facturas WHERE id = ?");
    $stmt->bind_param("i", $idEliminar);
    $stmt->execute();

    $desde = $_GET['desde'] ?? date("Y-m-d");
    $hasta = $_GET['hasta'] ?? date("Y-m-d");
    header("Location: reporte.php?desde=" . urlencode($desde) . "&hasta=" . urlencode($hasta));
    exit();
}


$fecha_desde = $_GET['desde'] ?? date("Y-m-d");
$fecha_hasta = $_GET['hasta'] ?? date("Y-m-d");

if ($fecha_desde > $fecha_hasta) {
    $tmp = $fecha_desde;
    $fecha_desde = $fecha_hasta;
    $fecha_hasta = $tmp;
}

$stmt = $conn->prepare("SELECT COUNT(*) AS total_facturas, SUM(total) AS total_cobrado 
                        FROM facturas 
                        WHERE fecha BETWEEN ? AND ?");
$stmt->bind_param("ss", $fecha_desde, $fecha_hasta);
$stmt->execute();
$resumen = $stmt->get_result()->fetch_assoc();

$total_facturas = $resumen['total_facturas'] ?? 0;
$total_cobrado = $resumen['total_cobrado'] ?? 0.00;

// Consulta facturas en rango
$stmt = $conn->prepare("SELECT f.id, f.numero_recibo, f.total, c.nombre AS cliente, f.fecha
                        FROM facturas f 
                        JOIN clientes c ON f.cliente_id = c.id 
                        WHERE f.fecha BETWEEN ? AND ?
                        ORDER BY f.fecha DESC, f.id DESC");
$stmt->bind_param("ss", $fecha_desde, $fecha_hasta);
$stmt->execute();
$facturas = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Facturas - La Rubia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h3>📊 Reporte de Facturas</h3>
            <a href="dashboard.php" class="btn btn-secondary">🔙 Volver</a>
        </div>
        <hr>

        <a href="administrar_clientes.php" class="btn btn-info mb-3">👥 Administrar Clientes</a>

        <!-- Filtro por rango de fechas -->
        <form method="GET" class="mb-4 row g-3 align-items-end">
            <div class="col-auto">
                <label for="desde" class="form-label">Desde:</label>
                <input type="date" id="desde" name="desde" class="form-control" value="<?= htmlspecialchars($fecha_desde) ?>" max="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="col-auto">
                <label for="hasta" class="form-label">Hasta:</label>
                <input type="date" id="hasta" name="hasta" class="form-control" value="<?= htmlspecialchars($fecha_hasta) ?>" max="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">🔍 Consultar</button>
            </div>
        </form>

        <div class="card p-4 mb-4">
            <p><strong>Desde:</strong> <?= date("d/m/Y", strtotime($fecha_desde)) ?></p>
            <p><strong>Hasta:</strong> <?= date("d/m/Y", strtotime($fecha_hasta)) ?></p>
            <p><strong>Total de facturas:</strong> <?= $total_facturas ?></p>
            <p><strong>Total cobrado:</strong> RD$ <?= number_format($total_cobrado, 2) ?></p>
        </div>

        <?php if ($facturas->num_rows > 0): ?>
            <div class="card p-4">
                <h5>🧾 Facturas</h5>
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Nº Recibo</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $facturas->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= date("d/m/Y", strtotime($row['fecha'])) ?></td>
                                <td><?= htmlspecialchars($row['numero_recibo']) ?></td>
                                <td><?= htmlspecialchars($row['cliente']) ?></td>
                                <td>RD$ <?= number_format($row['total'], 2) ?></td>
                                <td>
                                    <a href="imprimir.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" target="_blank">🖨️ Imprimir</a>
                                    <a href="reporte.php?desde=<?= urlencode($fecha_desde) ?>&hasta=<?= urlencode($fecha_hasta) ?>&eliminar=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar esta factura?')">🗑️ Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No hay facturas registradas para este rango de fechas.</div>
        <?php endif; ?>
    </div>
</body>
</html>
