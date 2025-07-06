<?php
$configFile = __DIR__ . '/conexion.php';

function test_connection($host, $user, $pass, $dbname = null) {
    $conn = @new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) return false;
    $conn->close();
    return true;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = $_POST['host'] ?? '';
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $dbname = $_POST['dbname'] ?? '';

    if (!$host || !$user || !$dbname) {
        $errors[] = "Por favor, complete todos los campos obligatorios.";
    } else {
        $conn = new mysqli($host, $user, $pass);
        if ($conn->connect_error) {
            $errors[] = "Error al conectar al servidor: " . $conn->connect_error;
        } else {
            // Crear base de datos si no existe
            if (!$conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
                $errors[] = "Error al crear la base de datos: " . $conn->error;
            } else {
                $conn->select_db($dbname);
                // Crear tabla personajes si no existe
                $sql = "CREATE TABLE IF NOT EXISTS personajes (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    descripcion TEXT,
                    imagen VARCHAR(255)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                if (!$conn->query($sql)) {
                    $errors[] = "Error al crear la tabla personajes: " . $conn->error;
                }
            }
            $conn->close();
        }
    }

    if (empty($errors)) {
        // Guardar archivo conexion.php con la configuración ingresada
        $contenido = "<?php\n"
            . "\$conexion = new mysqli(\"$host\", \"$user\", \"$pass\", \"$dbname\");\n"
            . "\$conexion->set_charset(\"utf8\");\n"
            . "if (\$conexion->connect_error) {\n"
            . "    die(\"Conexión fallida: \" . \$conexion->connect_error);\n"
            . "}\n";

        if (file_put_contents($configFile, $contenido)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "No se pudo guardar el archivo conexion.php. Verifica permisos en el servidor.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Asistente de Configuración de Base de Datos</title>
<style>
    body { font-family: Arial, sans-serif; max-width: 480px; margin: 40px auto; }
    label { display: block; margin-top: 10px; }
    input[type=text], input[type=password] { width: 100%; padding: 8px; margin-top: 5px; }
    button { margin-top: 15px; padding: 10px 20px; }
    .error { color: red; }
</style>
</head>
<body>
<h1>Configuración de la Base de Datos</h1>

<?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="">
    <label for="host">Servidor:</label>
    <input type="text" name="host" id="host" value="<?= htmlspecialchars($_POST['host'] ?? 'localhost') ?>" required>

    <label for="user">Usuario:</label>
    <input type="text" name="user" id="user" value="<?= htmlspecialchars($_POST['user'] ?? '') ?>" required>

    <label for="pass">Contraseña:</label>
    <input type="password" name="pass" id="pass">

    <label for="dbname">Base de datos:</label>
    <input type="text" name="dbname" id="dbname" value="<?= htmlspecialchars($_POST['dbname'] ?? '') ?>" required>

    <button type="submit">Guardar y configurar</button>
</form>
</body>
</html>
