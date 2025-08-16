<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];

    $archivo = '../data/usuarios.json';

    if (!file_exists($archivo)) {
        file_put_contents($archivo, json_encode([]));
    }

    $usuarios = json_decode(file_get_contents($archivo), true);

    foreach ($usuarios as $u) {
        if ($u['email'] === $email) {
            $error = "Este email ya está registrado.";
            break;
        }
    }

    if (!isset($error)) {
        $usuarios[] = [
            "nombre" => $nombre,
            "email" => $email,
            "telefono" => $telefono,
            "password" => $password
        ];

        file_put_contents($archivo, json_encode($usuarios, JSON_PRETTY_PRINT));

        $exito = "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/registro-styles.css">

</head>
<body>
    <div class="form-container">
        <h1>Crear Cuenta</h1>
        <form id="registroForm" method="POST" action="">
            <label for="nombre">Nombre completo</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required>

            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" placeholder="809-555-5555" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required>

            <button type="submit">Registrarse</button>
            <p class="redirect">¿Ya tienes cuenta? <a href="../login.php">Inicia sesión</a></p>
        </form>

    </div>

    <script src="js/script.js"></script>
</body>
</html>
