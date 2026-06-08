<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Carrito | Olivia's Panadería</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Arimo&display=swap" rel="stylesheet">
    <style>
        .carrito-container { padding: 50px 8%; background-color: #fffaf1; min-height: 80vh; }
        .tabla-carrito { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .tabla-carrito th { background-color: #5d3a1a; color: white; padding: 15px; text-align: left; }
        .tabla-carrito td { padding: 15px; border-bottom: 1px solid #eee; }
        .total-seccion { margin-top: 30px; text-align: right; font-family: 'Merriweather', serif; }
        .precio-total { color: #c05746; font-size: 2rem; font-weight: bold; }
        .btn-vaciar { background-color: #999; margin-right: 10px; }
        .btn-eliminar { color: #c05746; cursor: pointer; border: none; background: none; font-weight: bold; }

        
        .loader { 
            border: 8px solid #f3f3f3; 
            border-top: 8px solid #0070bb; 
            border-radius: 50%; 
            width: 50px; 
            height: 50px; 
            animation: spin 1s linear infinite; 
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <header class="navbar">
        <?php include 'header.php'; ?>
    </header>
    <main class="carrito-container">
        <h1 style="text-align: center; font-family: 'Merriweather', serif;">Tu Detalle de Compra</h1>
        
        <div id="contenido-carrito"></div>
        <div class="total-seccion" id="footer-carrito" style="display: none;">
            <p>Total a pagar:</p>
            <p class="precio-total" id="monto-total">$0</p>
            <br>
            <button class="btn btn-vaciar" onclick="vaciarCarrito()">Vaciar Carrito</button>
            <button class="btn" onclick="procesarPagoWebpay()" style="background-color: #0070bb;">
                Pagar con Webpay Plus
            </button>
        </div>
    </main>
    <script src="function.js"></script>
</body>
</html>