<?php
session_start();

// Si no está logueado, mandar al login
if (!isset($_SESSION['email'])) {
    header("Location: views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mapa de Incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Incidencias RD</a>
    <div>
      <a href="views/panel.php" class="btn btn-outline-light btn-sm">Panel</a>
    </div>
  </div>
</nav>

<div class="container-fluid p-0">
    <div id="map" style="height: 100vh;"></div>
</div>

<script>
    var map = L.map('map').setView([18.7357, -70.1627], 7); // Centro RD

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    // Marcadores simulados
    var marker1 = L.marker([18.4861, -69.9312]).addTo(map);
    marker1.bindPopup("<b>Accidente</b><br>Sto. Domingo");

    var marker2 = L.marker([19.4517, -70.6970]).addTo(map);
    marker2.bindPopup("<b>Robo</b><br>Santiago");
</script>

</body>
</html>
