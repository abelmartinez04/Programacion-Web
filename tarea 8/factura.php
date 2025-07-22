<?php
session_start();
require_once 'includes/db.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Función para generar código único para nuevo cliente
function generarCodigoCliente($conn) {
    do {
        $codigo = str_pad(rand(0, 9999), 4, "0", STR_PAD_LEFT);
        $stmt = $conn->prepare("SELECT id FROM clientes WHERE codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $res = $stmt->get_result();
    } while ($res->num_rows > 0);
    return $codigo;
}

// Traer todos los clientes para el select
$clientes = $conn->query("SELECT id, codigo, nombre FROM clientes ORDER BY nombre")->fetch_all(MYSQLI_ASSOC);

// Traer articulos
$articulosDB = $conn->query("SELECT nombre, precio FROM articulos")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_cliente = $_POST['tipo_cliente'] ?? 'nuevo';
    $comentario = $_POST['comentario'] ?? '';
    $fecha = date("Y-m-d");
    $articulos = $_POST['articulos'] ?? [];
    $total_general = 0;
    
    if ($tipo_cliente === 'nuevo') {
        // Nuevo cliente: generar código y nombre desde formulario
        $nombre_cliente = trim($_POST['nombre_cliente_nuevo'] ?? '');
        if (empty($nombre_cliente)) {
            die("Debe ingresar el nombre del nuevo cliente.");
        }
        $codigo_cliente = generarCodigoCliente($conn);

        // Insertar cliente nuevo
        $stmt = $conn->prepare("INSERT INTO clientes (codigo, nombre) VALUES (?, ?)");
        $stmt->bind_param("ss", $codigo_cliente, $nombre_cliente);
        $stmt->execute();
        $cliente_id = $stmt->insert_id;

    } else {
        // Cliente existente: obtener id seleccionado y nombre editable
        $cliente_id = intval($_POST['cliente_existente'] ?? 0);
        $nombre_editable = trim($_POST['nombre_cliente_existente'] ?? '');

        if ($cliente_id <= 0) {
            die("Debe seleccionar un cliente existente.");
        }

        // Actualizar nombre si fue editado
        if ($nombre_editable !== '') {
            $stmt = $conn->prepare("UPDATE clientes SET nombre = ? WHERE id = ?");
            $stmt->bind_param("si", $nombre_editable, $cliente_id);
            $stmt->execute();
        }
    }

    // Generar número de recibo
    $recibo = 'REC-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

    // Insertar factura
    $stmt = $conn->prepare("INSERT INTO facturas (numero_recibo, fecha, cliente_id, comentario, total) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssis", $recibo, $fecha, $cliente_id, $comentario);
    $stmt->execute();
    $factura_id = $stmt->insert_id;

    // Insertar detalles factura
    $stmt = $conn->prepare("INSERT INTO factura_detalles (factura_id, articulo, cantidad, precio, total) VALUES (?, ?, ?, ?, ?)");
    foreach ($articulos as $art) {
        $articulo = $art['nombre'];
        $cantidad = intval($art['cantidad']);
        $precio = floatval($art['precio']);
        $total = $cantidad * $precio;
        $total_general += $total;
        $stmt->bind_param("isidd", $factura_id, $articulo, $cantidad, $precio, $total);
        $stmt->execute();
    }

    // Actualizar total factura
    $stmt = $conn->prepare("UPDATE facturas SET total = ? WHERE id = ?");
    $stmt->bind_param("di", $total_general, $factura_id);
    $stmt->execute();

    // Redirigir según acción
    $accion = $_POST['accion'] ?? 'guardar';
    if ($accion === 'imprimir') {
        header("Location: imprimir.php?id=$factura_id");
    } else {
        header("Location: dashboard.php");
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Factura - La Rubia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        const precios = <?= json_encode($articulosDB) ?>;
        let indice = 1;

        function toggleCliente(tipo) {
            if (tipo === 'nuevo') {
                document.getElementById('nuevoCliente').style.display = 'block';
                document.getElementById('existenteCliente').style.display = 'none';

                document.getElementById('nombre_cliente_nuevo').required = true;
                document.getElementById('cliente_existente').required = false;
            } else {
                document.getElementById('nuevoCliente').style.display = 'none';
                document.getElementById('existenteCliente').style.display = 'block';

                document.getElementById('nombre_cliente_nuevo').required = false;
                document.getElementById('cliente_existente').required = true;
            }
        }

        function llenarCodigo() {
            const select = document.getElementById('cliente_existente');
            const codigoInput = document.getElementById('codigo_cliente');
            const nombreInput = document.getElementById('nombre_cliente_existente');

            const opcion = select.options[select.selectedIndex];
            if (opcion.value !== '') {
                codigoInput.value = opcion.getAttribute('data-codigo');
                nombreInput.value = opcion.getAttribute('data-nombre');
            } else {
                codigoInput.value = '';
                nombreInput.value = '';
            }
        }

        function agregarFila() {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>
                    <select name="articulos[${indice}][nombre]" class="form-select" onchange="actualizarPrecio(this); calcularTotal()" required>
                        <option value="">-- Seleccionar --</option>
                        ${precios.map(art => `<option value="${art.nombre}">${art.nombre}</option>`).join('')}
                    </select>
                </td>
                <td><input type="number" name="articulos[${indice}][cantidad]" class="form-control" value="1" min="1" onchange="calcularTotal()" required></td>
                <td><input type="number" name="articulos[${indice}][precio]" class="form-control" step="0.01" onchange="calcularTotal()" required></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">❌</button></td>
            `;
            document.getElementById('tabla-articulos').appendChild(fila);
            indice++;
            calcularTotal();
        }

        function eliminarFila(btn) {
            const fila = btn.closest('tr');
            fila.remove();
            calcularTotal();
        }

        function actualizarPrecio(select) {
            const selected = select.value;
            const fila = select.closest('tr');
            const precioInput = fila.querySelector('input[name*="[precio]"]');
            const art = precios.find(a => a.nombre === selected);
            if (art) precioInput.value = art.precio;
            calcularTotal();
        }

        function calcularTotal() {
            const filas = document.querySelectorAll('#tabla-articulos tr');
            let total = 0;
            filas.forEach(fila => {
                const cantidad = parseFloat(fila.querySelector('input[name*="[cantidad]"]').value) || 0;
                const precio = parseFloat(fila.querySelector('input[name*="[precio]"]').value) || 0;
                total += cantidad * precio;
            });
            document.getElementById('totalGeneral').textContent = total.toFixed(2);
        }

        window.onload = () => {
            toggleCliente('nuevo');
        };
    </script>
</head>
<body class="bg-light">
    <header class="bg-success bg-opacity-50 p-3 mb-4 text-center text-white">
        <h2>Registrar Nueva Factura - La Rubia</h2>
    </header>

    <div class="container">
        <form method="POST">
            <div class="mb-3">
                <label>Tipo de Cliente</label><br>
                <input type="radio" name="tipo_cliente" id="tipoNuevo" value="nuevo" checked onchange="toggleCliente('nuevo')">
                <label for="tipoNuevo">Nuevo</label>
                &nbsp;&nbsp;
                <input type="radio" name="tipo_cliente" id="tipoExistente" value="existente" onchange="toggleCliente('existente')">
                <label for="tipoExistente">Existente</label>
            </div>

            <div id="nuevoCliente">
                <label for="nombre_cliente_nuevo">Nombre del Cliente</label>
                <input type="text" id="nombre_cliente_nuevo" name="nombre_cliente_nuevo" class="form-control" placeholder="Ingrese nombre del cliente">
            </div>

            <div id="existenteCliente" style="display:none;">
                <label for="cliente_existente">Seleccione Cliente Existente</label>
                <select id="cliente_existente" name="cliente_existente" class="form-select" onchange="llenarCodigo()">
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option 
                            value="<?= $cliente['id'] ?>" 
                            data-codigo="<?= htmlspecialchars($cliente['codigo']) ?>" 
                            data-nombre="<?= htmlspecialchars($cliente['nombre']) ?>"
                        >
                            <?= htmlspecialchars($cliente['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="codigo_cliente" class="mt-3">Código Cliente</label>
                <input type="text" id="codigo_cliente" class="form-control" disabled>

                <label for="nombre_cliente_existente" class="mt-3">Nombre del Cliente</label>
                <input type="text" id="nombre_cliente_existente" name="nombre_cliente_existente" class="form-control" placeholder="Nombre editable">
            </div>

            <hr>

            <h5>Artículos</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tabla-articulos">
                </tbody>
            </table>
            <button type="button" class="btn btn-primary mb-3" onclick="agregarFila()">Agregar Artículo</button>

            <div class="mb-3">
                <label>Total General: </label> <span id="totalGeneral">0.00</span>
            </div>

            <div class="mb-3">
                <label for="comentario">Comentario</label>
                <textarea name="comentario" id="comentario" class="form-control" rows="3"></textarea>
            </div>

            
            <button type="submit" name="accion" value="guardar" class="btn btn-success">Guardar</button>
            <button type="submit" name="accion" value="imprimir" class="btn btn-secondary">Guardar e Imprimir</button>
            <a href="dashboard.php" class="btn btn-secondary">🔙 Volver</a>
        </form>
    </div>

    <script>
        agregarFila(); // Agrega una fila al cargar la página
    </script>
</body>
</html>
