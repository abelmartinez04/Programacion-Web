<?php 
session_start(); 
$nombre = $_SESSION['nombre'] ?? 'Usuario';
$email = $_SESSION['email'] ?? 'usuario@correo.com';
$telefono = $_SESSION['telefono'] ?? '809-555-5555';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil de Usuario</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Incidencias RD</a>
    <div>
      <a href="../controllers/logout.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
    </div>
  </div>
</nav>

<div class="container py-5">
    <h2 class="text-center mb-4">Mi Perfil</h2>

    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h5 class="card-title text-center mb-3" id="perfilNombre"><?= $nombre ?></h5>

            <p><strong>Correo:</strong> <span id="perfilEmail"><?= $email ?></span></p>
            <p><strong>Teléfono:</strong> <span id="perfilTelefono"><?= $telefono ?></span></p>

            <div class="d-grid gap-2 mt-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                    Editar Información
                </button>
                <a href="panel.php" class="btn btn-secondary">Volver al Panel</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar perfil -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarPerfilLabel">Editar Perfil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input type="text" id="inputNombre" class="form-control" value="<?= $nombre ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" id="inputEmail" class="form-control" value="<?= $email ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="tel" id="inputTelefono" class="form-control" value="<?= $telefono ?>">
            </div>

            <hr>
            <h6>Cambiar Contraseña</h6>
            <div class="mb-3 position-relative">
                <label class="form-label">Nueva contraseña</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Mínimo 6 caracteres">
                <button type="button" id="togglePassword" class="btn-show-password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="guardarPerfil">Guardar Cambios</button>
        </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Guardar cambios de perfil y contraseña
document.getElementById('guardarPerfil').addEventListener('click', function() {
    const nombre = document.getElementById('inputNombre').value;
    const email = document.getElementById('inputEmail').value;
    const telefono = document.getElementById('inputTelefono').value;
    const nuevaPassword = document.getElementById('inputPassword').value;

    // Actualiza vista
    document.getElementById('perfilNombre').textContent = nombre;
    document.getElementById('perfilEmail').textContent = email;
    document.getElementById('perfilTelefono').textContent = telefono;

    // Llamada AJAX para guardar en usuarios.json y sesión
    fetch('../controllers/actualizar_perfil.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({nombre,email,telefono,nuevaPassword})
    })
    .then(res => res.text())
    .then(data => {
        alert('✅ Perfil actualizado correctamente');
        document.getElementById('inputPassword').value = '';
        var modal = bootstrap.Modal.getInstance(document.getElementById('editarPerfilModal'));
        modal.hide();
    });
});

// Mostrar/Ocultar contraseña
const togglePassword = document.getElementById('togglePassword');
const inputPassword = document.getElementById('inputPassword');
if (togglePassword && inputPassword) {
    const icon = togglePassword.querySelector('i');
    togglePassword.addEventListener('click', function () {
        const type = inputPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        inputPassword.setAttribute('type', type);
        if (icon) {
            if (type === 'password') {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    });
}
</script>
</body>
</html>
