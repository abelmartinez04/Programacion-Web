<?php
session_start();
require_once 'includes/db.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        if (password_verify($clave, $fila['clave'])) {
            $_SESSION['usuario'] = $usuario;
            header("Location: dashboard.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - La Rubia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <h4 class="text-center mb-4">Ingreso al Sistema</h4>
                <?php if ($mensaje): ?>
                    <div class="alert alert-danger"><?= $mensaje ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label>Usuario</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="clave" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Entrar</button>
                </form>
                <p class="mt-3 text-muted text-center">Usuario por defecto: <strong>demo</strong><br>Clave: <strong>tareafacil25</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
