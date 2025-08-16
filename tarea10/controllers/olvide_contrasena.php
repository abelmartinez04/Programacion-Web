<?php
session_start();
$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);

$mostrarRestablecer = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $usuarios = json_decode(file_get_contents('../data/usuarios.json'), true);

    $encontrado = false;
    foreach ($usuarios as $u) {
        if ($u['email'] === $email) {
            $encontrado = true;
            $codigo = rand(100000, 999999);
            $_SESSION['reset_email'] = $email;
            $_SESSION['reset_code'] = $codigo;
            $mensaje = "Código de recuperación: <b>$codigo</b> (simulado)";
            $mostrarRestablecer = true; // mostramos el botón solo si el usuario existe
            break;
        }
    }
    if (!$encontrado) {
        $mensaje = "Correo no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/styles.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Recuperar Contraseña</h3>

        <?php if($mensaje): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <?php if(!$mostrarRestablecer): ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar Código</button>
            </form>
        <?php else: ?>
            <a href="restablecer_contrasena.php" class="btn btn-success w-100 mt-3">Restablecer Contraseña</a>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
