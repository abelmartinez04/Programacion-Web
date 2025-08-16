<?php
session_start();
$mensaje = '';
$tipoMensaje = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $nueva = $_POST['nueva'];

    if (isset($_SESSION['reset_code']) && $codigo == $_SESSION['reset_code']) {
        $usuarios = json_decode(file_get_contents('../data/usuarios.json'), true);
        foreach ($usuarios as &$u) {
            if ($u['email'] === $_SESSION['reset_email']) {
                $u['password'] = $nueva;
                break;
            }
        }
        file_put_contents('../data/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));
        $mensaje = "✅ Contraseña actualizada. <a href='../views/login.php'>Inicia sesión</a>";
        $tipoMensaje = 'success';
        unset($_SESSION['reset_code'], $_SESSION['reset_email']);
    } else {
        $mensaje = "❌ Código incorrecto.";
        $tipoMensaje = 'danger';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Restablecer Contraseña</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="../views/css/styles.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Restablecer Contraseña</h3>

        <?php if($mensaje): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?>" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" placeholder="Ingresa el código" required>
            </div>

            <div class="mb-3 position-relative">
                <label class="form-label">Nueva Contraseña</label>
                <input type="password" name="nueva" id="password" class="form-control" placeholder="Mínimo 6 caracteres" required>
                <button type="button" id="togglePassword" class="btn-show-password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <button type="submit" class="btn btn-primary w-100">Actualizar Contraseña</button>
        </form>
    </div>
</div>

<script src="../views/js/script.js"></script>
</body>
</html>
