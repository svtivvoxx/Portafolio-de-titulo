<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
        body { margin: 0; font-family: sans-serif; background-color: #ddd7c6; }
        .navbar {
            background-color: #050300;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .contenido-central {
            height: calc(100vh - 70px); 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
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
    <main class="contenido-central">
        <h1>Compra Exitosa!</h1>
        <p>¡Gracias por tu compra! Tu pago ha sido procesado exitosamente.</p>
        <a href="index.php">Volver al inicio</a>
    </main>
    <script>
    localStorage.removeItem('carrito');
    if (typeof actualizarContadorCarrito === 'function') {
        actualizarContadorCarrito();
    }
    console.log("Carrito vaciado tras compra exitosa.");
</script>
</body>
</html>