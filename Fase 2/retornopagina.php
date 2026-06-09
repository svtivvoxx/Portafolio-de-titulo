<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error en el pago</title>
    <style>
        /* Estilos generales */
        body { margin: 0; font-family: sans-serif; background-color: #e4ddcc; }

        /* Navbar estilo tienda */
        .navbar {
            background-color: #030200;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Contenedor centralizado para el mensaje */
        .contenido-central {
            height: calc(100vh - 70px); /* Restamos la altura del navbar */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        /* Estilo del botón */
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #5d3a1a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <header class="navbar">
        Olivia's Panadería
    </header>

    <main class="contenido-central">
        <h1>Upss ha ocurrido un error!</h1>
        <p>Tu pago ha sido cancelado o rechazado!.</p>
        <a href="index.php">Volver al inicio</a>
    </main>

</body>
</html>