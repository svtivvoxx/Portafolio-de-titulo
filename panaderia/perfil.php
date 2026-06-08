<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}
$nombreUsuario = $_SESSION['usuario_nombre'];
$rolUsuario = $_SESSION['usuario_rol'] ?? 'cliente';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil | Olivia's Panadería</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Arimo&display=swap" rel="stylesheet">
    
    <style>
        body { background-color: #fffaf1; font-family: 'Arimo', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Merriweather', serif; color: #5d3a1a; }
        .navbar-custom { background-color: #5d3a1a; }
        .navbar-custom .nav-link, .navbar-custom .navbar-brand { color: #fffaf1 !important; }
        .navbar-custom .nav-link:hover { color: #ffeb3b !important; }
        
        .perfil-container { padding: 40px 15px; min-height: 80vh; }
        .perfil-card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto 40px auto; text-align: center; border-top: 4px solid #5d3a1a; }
        
        .btn-logout { background-color: #c05746; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; text-decoration: none; display: inline-block; margin-top: 15px; transition: 0.2s; }
        .btn-logout:hover { background-color: #a04334; color: white; }
        
        .btn-admin { background-color: #27ae60; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; text-decoration: none; display: inline-block; margin-top: 15px; margin-right: 10px; transition: 0.2s; }
        .btn-admin:hover { background-color: #1e7e43; color: white; }
        .grid-recomendaciones { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px; }
        .item-recomendado { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); text-align: center; border-top: 4px solid #5d3a1a; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Olivia's Panadería</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="filter: invert(1);">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="Index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="catalogo.php">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="nosotros.php">Sobre Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li> 
                <li class="nav-item"><a class="nav-link" href="carrito.php">Carrito 🛒 <span id="carrito-cantidad">0</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container perfil-container">
    <div class="perfil-card">
        <h2>Bienvenido(a), <?php echo htmlspecialchars($nombreUsuario); ?></h2>
        <p class="text-muted">Nivel de privilegios actual: <strong class="text-uppercase"><?php echo htmlspecialchars($rolUsuario); ?></strong></p>
        <hr>
        <div class="mt-3">
            <?php if ($rolUsuario === 'admin' || $rolUsuario === 'empleado'): ?>
                <a href="admin.php" class="btn-admin">Ir al Panel de Administración</a>
            <?php endif; ?>
            <a href="cierresesion.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </div>
    <div class="max-width-900 mx-auto" style="max-width: 900px;">
        <h3 class="text-center mb-4">Recomendaciones Especiales para Ti</h3>
        <div class="grid-recomendaciones">
            <div class="item-recommended item-recomendado">
                <div class="fs-2 mb-2">🍞</div>
                <h4>Pan de Molde Integral</h4>
                <p class="text-muted" style="font-size: 0.9rem;">Perfecto para tus desayunos, alto en fibra y bajo en sodio.</p>
            </div>
            <div class="item-recommended item-recomendado">
                <div class="fs-2 mb-2">🍪</div>
                <h4>Galletas de Avena</h4>
                <p class="text-muted" style="font-size: 0.9rem;">Endulzadas con estevia natural, ideales para diabéticos.</p>
            </div>
            <div class="item-recommended item-recomendado">
                <div class="fs-2 mb-2">🧁</div>
                <h4>Muffin Sin Gluten</h4>
                <p class="text-muted" style="font-size: 0.9rem;">Elaborado en un entorno 100% seguro para celíacos.</p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="function.js"></script>
</body>
</html>