<?php require_once 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo | Olivia's Panadería</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Arimo&display=swap"
        rel="stylesheet">
    <style>
        .catalogo-container {
            padding: 50px 8%;
            background-color: #fffaf1;
        }

        .categoria-titulo {
            font-family: 'Merriweather', serif;
            color: #5d3a1a;
            border-bottom: 2px solid #c05746;
            margin: 40px 0 20px 0;
            padding-bottom: 10px;
        }

        .grid-productos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .producto-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            text-align: center;
            border: 1px solid #eee;
            transition: transform 0.3s;
        }

        .producto-card:hover {
            transform: translateY(-5px);
        }

        .producto-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .precio {
            color: #c05746;
            font-weight: bold;
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .controles-compra {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .cantidad-input {
            width: 50px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <?php include 'header.php'; ?>
    </header>
    <main class="catalogo-container">
        <h1 style="text-align: center; font-family: 'Merriweather', serif;">Nuestro Catálogo Artesanal</h1>
        <h2 class="categoria-titulo">Semillas & Integrales</h2>
        <div class="grid-productos">
            <?php
            $productos = $conexion->query("SELECT * FROM productos WHERE categoria= 'Integral'");
            while ($prod = $productos->fetch_assoc()): ?>
                <div class="producto-card">
                    <img src="images/pan integral.webp" alt="Pan">
                    <h3><?php echo htmlspecialchars($prod['nombre']); ?></h3>
                    <p class="precio"><?php echo htmlspecialchars($prod['precio']); ?></p>
                    <div class="controles-compra">
                        <div><label>Cantidad:</label> <input type="number" class="cantidad-input" value="1" min="1"></div>
                        <button class="btn"
                            onclick="agregarAlCarrito(<?php echo htmlspecialchars(json_encode($prod['nombre'])); ?>, <?php echo (int) $prod['precio']; ?>, this)">Añadir
                            al Carrito</button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        </div>
        <h2 class="categoria-titulo">Línea Sin Gluten</h2>
        <div class="grid-productos">
            <?php
            $productos = $conexion->query("SELECT * FROM productos WHERE categoria= 'Sin Gluten'");
            while ($prod = $productos->fetch_assoc()): ?>
                <div class="producto-card">
                    <img src="images/pan-sin-gluten.jpg" alt="Pan">
                    <h3><?php echo htmlspecialchars($prod['nombre']); ?></h3>
                    <p class="precio"><?php echo htmlspecialchars($prod['precio']); ?></p>
                    <div class="controles-compra">
                        <div><label>Cantidad:</label> <input type="number" class="cantidad-input" value="1" min="1"></div>
                        <button class="btn"
                            onclick="agregarAlCarrito(<?php echo htmlspecialchars(json_encode($prod['nombre'])); ?>, <?php echo (int) $prod['precio']; ?>, this)">Añadir
                            al Carrito</button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        </div>
        <h2 class="categoria-titulo">Especialidades Veganas</h2>
        <div class="grid-productos">
            <?php
            $productos = $conexion->query("SELECT * FROM productos WHERE categoria= 'Vegano'");
            while ($prod = $productos->fetch_assoc()): ?>
                <div class="producto-card">
                    <img src="images/queso.jpg" alt="Pan">
                    <h3><?php echo htmlspecialchars($prod['nombre']); ?></h3>
                    <p class="precio"><?php echo htmlspecialchars($prod['precio']); ?></p>
                    <div class="controles-compra">
                        <div><label>Cantidad:</label> <input type="number" class="cantidad-input" value="1" min="1"></div>
                        <button class="btn"
                            onclick="agregarAlCarrito(<?php echo htmlspecialchars(json_encode($prod['nombre'])); ?>, <?php echo (int) $prod['precio']; ?>, this)">
                            Añadir al Carrito
                        </button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        </div>
    </main>
    <script src="function.js"></script>
</body>

</html>