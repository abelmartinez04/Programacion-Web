<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? "Mi App de Naruto" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-naruto {
            background-color: #2c3e50;
            border-bottom: 4px solid #f39c12;
        }
        .navbar-brand img {
            height: 30px;
            margin-right: 10px;
        }
        .btn-naruto {
            background-color: #f39c12;
            color: #fff;
        }
        .btn-naruto:hover {
            background-color: #e67e22;
        }
        .table th {
            background-color: #f39c12;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-naruto">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="https://static.vecteezy.com/system/resources/previews/026/620/795/non_2x/konoha-symbol-hidden-leaf-naruto-free-vector.jpg" alt="Konoha">
            <span>Naruto Ninja Base</span>
        </a>
        <div>
            <a href="agregar.php" class="btn btn-naruto me-2">+ Agregar Ninja</a>
            <a href="acerca.php" class="btn btn-outline-light">Acerca de</a>
        </div>
    </div>
</nav>

<div class="container mt-4">


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

