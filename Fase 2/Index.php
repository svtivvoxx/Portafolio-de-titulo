<?php require_once 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olivia's Panadería | Artesanal y Saludable</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Arimo&display=swap"
        rel="stylesheet">
    <style>
        .hero {
            position: relative;
            overflow: hidden;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .carrusel-fotos {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .foto {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            animation: carruselAnimacion 15s infinite;
        }

        .foto:nth-child(1) {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('pan-artesanal-1.jpg');
            animation-delay: 0s;
        }

        .foto:nth-child(2) {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('pan-artesanal-2.jpg');
            animation-delay: 5s;
        }

        .foto:nth-child(3) {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('pan-artesanal-3.jpg');
            animation-delay: 10s;
        }

        @keyframes carruselAnimacion {
            0% {
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            33% {
                opacity: 1;
            }

            43% {
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        .hero-content {
            z-index: 1;
            padding: 20px;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <?php include 'header.php'; ?>
    </header>
    <section class="hero">
        <div class="carrusel-fotos">
            <div class="foto"></div>
            <div class="foto"></div>
            <div class="foto"></div>
        </div>
        <div class="hero-content">
            <h1>Salud en cada bocado</h1>
            <p>Panadería artesanal con ingredientes 100% naturales.</p>
            <a href="catalogo.php" class="btn">Ver Catálogo</a>
        </div>
    </section>
    <section class="features">
        <div class="column">
            <h3>Sin Gluten</h3>
            <p>Especialmente elaborado para celíacos en ambientes controlados.</p>

            <div class="oferta-destacada">
                <img src="muffin-destacado.jpg" alt="Oferta Sin Gluten">
                <h4>Pan Integral</h4>
                <p class="precio-tachado"><s>$2.500</s></p>
                <p class="precio-oferta">$1.990</p>
                <a href="catalogo.php" class="btn-sm">¡Aprovechar Oferta!</a>
            </div>
        </div>
        <div class="column">
            <h3>100% Vegano</h3>
            <p>Sin masa madre de origen animal ni lácteos.</p>

            <div class="oferta-destacada">
                <img src="focaccia-destacada.jpg" alt="Oferta Vegana">
                <h4>Soja vegana</h4>
                <p class="precio-tachado"><s>$3.500</s></p>
                <p class="precio-oferta">$2.800</p>
                <a href="catalogo.php" class="btn-sm">¡Aprovechar Oferta!</a>
            </div>
        </div>
        <div class="column">
            <h3>Integral</h3>
            <p>Rico en fibra, ideal para tu digestión diaria.</p>

            <div class="oferta-destacada">
                <img src="images/pan-integral-destacado.jpg" alt="Oferta Integral">
                <h4>Pan de Molde 100%</h4>
                <p class="precio-tachado"><s>$4.000</s></p>
                <p class="precio-oferta">$3.200</p>
                <a href="catalogo.php" class="btn-sm">¡Aprovechar Oferta!</a>
            </div>
        </div>
    </section>
    <section class="features">
        </section>

    <?php include 'footer.php'; ?>
        <script src="function.js"></script>
</body>

</html>