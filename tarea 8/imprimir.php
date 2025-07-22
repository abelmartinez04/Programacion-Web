<?php
require_once 'includes/db.php';

if (!isset($_GET['id'])) {
    echo "ID de factura no proporcionado.";
    exit();
}

$factura_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT f.numero_recibo, f.fecha, f.comentario, f.total, c.nombre AS cliente, c.codigo AS codigo_cliente 
                        FROM facturas f
                        JOIN clientes c ON f.cliente_id = c.id
                        WHERE f.id = ?");
$stmt->bind_param("i", $factura_id);
$stmt->execute();
$res = $stmt->get_result();
$factura = $res->fetch_assoc();

if (!$factura) {
    echo "Factura no encontrada.";
    exit();
}

$stmt = $conn->prepare("SELECT articulo, cantidad, precio, total 
                        FROM factura_detalles 
                        WHERE factura_id = ?");
$stmt->bind_param("i", $factura_id);
$stmt->execute();
$detalles = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura - La Rubia</title>
    <style>
        @media print {
            .no-print { display: none; }
        }
        body {
            background: white;
            font-family: 'Courier New', Courier, monospace;
            color: #155724;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .contenedor {
            width: 100%;
            max-width: 480px;
        }
        header, footer {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            text-align: center;
            font-weight: bold;
        }
        .datos p {
            margin: 3px 0;
        }
        .datos strong {
            display: inline-block;
            width: 140px;
        }
        h4 {
            color: #155724;
            margin-top: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 10px;
        }
        th, td {
            border-bottom: 1px solid #155724;
            padding: 4px 6px;
        }
        thead th {
            border-bottom: 2px solid #155724;
        }
        td.cantidad, th.cantidad {
            width: 45px;
            text-align: center;
        }
        td.precio, th.precio,
        td.total, th.total {
            width: 90px;
            text-align: right;
        }
        .comentario {
            margin-top: 15px;
            font-weight: bold;
        }
        .total-pagar {
            margin-top: 15px;
            font-weight: bold;
            text-align: right;
        }
        .botones {
            text-align: center;
            margin-top: 25px;
        }
        button, a.btn {
            background-color: #155724;
            color: white;
            border: none;
            padding: 10px 16px;
            font-weight: bold;
            text-decoration: none;
            margin: 5px;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
        }
        button:hover, a.btn:hover {
            background-color: #0b2e13;
        }
        footer {
            font-size: 13px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="contenedor">

    <header>
        Sistema de Ventas - La Rubia<br>
        Factura de Compra
    </header>

    <div class="datos">
        <p><strong>Nº Recibo:</strong> <?= htmlspecialchars($factura['numero_recibo']) ?></p>
        <p><strong>Fecha:</strong> <?= date("d/m/Y", strtotime($factura['fecha'])) ?></p>
        <p><strong>Código Cliente:</strong> <?= htmlspecialchars($factura['codigo_cliente']) ?></p>
        <p><strong>Nombre Cliente:</strong> <?= htmlspecialchars($factura['cliente']) ?></p>
    </div>

    <h4>ARTÍCULOS VENDIDOS</h4>
    <hr style="border: 1px solid #155724;">

    <table>
        <thead>
            <tr>
                <th class="cantidad">CANT.</th>
                <th class="precio">PRECIO</th>
                <th>DESCRIPCIÓN</th>
                <th class="total">TOTAL</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $total_articulos = 0;
        while ($row = $detalles->fetch_assoc()): 
            $cantidad = intval($row['cantidad']);
            $articulo = trim($row['articulo']);
            if ($cantidad > 0 && $articulo !== ''):
                $precio = floatval($row['precio']);
                $total_articulo = floatval($row['total']);
                $total_articulos += $total_articulo;
        ?>
            <tr>
                <td class="cantidad"><?= $cantidad ?></td>
                <td class="precio">RD$ <?= number_format($precio, 2) ?></td>
                <td><?= htmlspecialchars(strtoupper($articulo)) ?></td>
                <td class="total">RD$ <?= number_format($total_articulo, 2) ?></td>
            </tr>
        <?php endif; endwhile; ?>
        </tbody>
    </table>

    <div class="comentario">
        <strong>COMENTARIO:</strong> <?= htmlspecialchars(strtoupper($factura['comentario'])) ?>
    </div>

    <div class="total-pagar">
        TOTAL A PAGAR: RD$ <?= number_format(floatval($factura['total']), 2) ?>
    </div>

    <div class="botones no-print">
        <button onclick="window.print()">🖨️ Guardar e Imprimir</button>
        <a href="reporte.php" class="btn">🔙 Volver</a>
    </div>

    <footer>
        Gracias por su compra. ¡Vuelva pronto!<br>
        La Rubia &copy; <?= date("Y") ?>
    </footer>

</div>
</body>
</html>
