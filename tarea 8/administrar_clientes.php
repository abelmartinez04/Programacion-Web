<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$mensaje = '';
$error = '';

if (isset($_POST['agregar'])) {
    $nombre = trim($_POST['nombre']);
    if ($nombre === '') {
        $error = "El nombre del cliente no puede estar vacío.";
    } else {
        $stmt = $conn->prepare("INSERT INTO clientes (nombre) VALUES (?)");
        $stmt->bind_param("s", $nombre);
        if ($stmt->execute()) {
            $mensaje = "Cliente agregado exitosamente.";
        } else {
            $error = "Error al agregar cliente.";
        }
    }
}

if (isset($_POST['editar'])) {
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre']);
    if ($nombre === '') {
        $error = "El nombre del cliente no puede estar vacío.";
    } else {
        $stmt = $conn->prepare("UPDATE clientes SET nombre = ? WHERE id = ?");
        $stmt->bind_param("si", $nombre, $id);
        if ($stmt->execute()) {
            $mensaje = "Cliente actualizado exitosamente.";
        } else {
            $error = "Error al actualizar cliente.";
        }
    }
}

if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);

    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM facturas WHERE cliente_id = ?");
    $stmt->bind_param("i", $idEliminar);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res['total'] > 0) {
        $error = "No se puede eliminar este cliente porque tiene facturas asociadas.";
    } else {
        $stmt = $conn->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->bind_param("i", $idEliminar);
        if ($stmt->execute()) {
            $mensaje = "Cliente eliminado exitosamente.";
        } else {
            $error = "Error al eliminar cliente.";
        }
    }
}

$result = $conn->query("SELECT * FROM clientes ORDER BY nombre ASC");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Clientes - La Rubia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    function editarCliente(id, nombre) {
        document.getElementById('id').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('btn-agregar').style.display = 'none';
        document.getElementById('btn-editar').style.display = 'inline-block';
        document.getElementById('titulo-form').innerText = 'Editar Cliente';
    }
    function limpiarFormulario() {
        document.getElementById('id').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('btn-agregar').style.display = 'inline-block';
        document.getElementById('btn-editar').style.display = 'none';
        document.getElementById('titulo-form').innerText = 'Agregar Cliente';
    }
    </script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>🧑‍💼 Administrar Clientes</h3>
        <a href="reporte.php" class="btn btn-secondary">🔙 Volver a Reporte</a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card mb-4 p-4">
        <h5 id="titulo-form">Agregar Cliente</h5>
        <form method="POST" onsubmit="return confirm('¿Confirmas esta acción?');">
            <input type="hidden" id="id" name="id" value="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del cliente:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <button type="submit" id="btn-agregar" name="agregar" class="btn btn-primary">Agregar</button>
            <button type="submit" id="btn-editar" name="editar" class="btn btn-warning" style="display:none;">Actualizar</button>
            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">Cancelar</button>
        </form>
    </div>

    <div class="card p-4">
        <h5>Clientes Registrados</h5>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($cliente = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $cliente['id'] ?></td>
                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="editarCliente(<?= $cliente['id'] ?>, '<?= addslashes(htmlspecialchars($cliente['nombre'])) ?>')">✏️ Editar</button>
                                <a href="administrar_clientes.php?eliminar=<?= $cliente['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este cliente?')">🗑️ Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">No hay clientes registrados.</div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
