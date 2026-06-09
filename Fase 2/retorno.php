<?php
session_start();
require_once 'vendor/autoload.php';

use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
$token = $_POST['token_ws'] ?? $_GET['token_ws'] ?? null;

if (!$token) {
    echo "<h3>Pago anidado o cancelado por el usuario.</h3>";
    echo "<a href='carrito.php'>Volver al carrito</a>";
    exit();
}
try {
    
    $options = WebpayPlus::getDefaultOptions();
    $transaction = new Transaction($options);
    
    $response = $transaction->commit($token);
    if ($response->isApproved()) {
        $montoPagado = $response->getAmount();
        $ordenCompra = $response->getBuyOrder();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>¡Compra Exitosa!</title>
            <link rel="stylesheet" href="style.css">
            <style>
                .exito-box { max-width: 500px; margin: 80px auto; padding: 40px; background: white; text-align: center; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
                .exito-box h1 { color: #27ae60; margin-bottom: 20px; }
                .btn-volver { display: inline-block; background: #5d3a1a; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; margin-top: 20px; font-weight: bold; }
            </style>
        </head>
        <body style="background-color: #fffaf1; font-family: Arial, sans-serif;">
            <div class="exito-box">
                <h1>¡Pago Aprobado! 🎉</h1>
                <p>Tu orden de compra <strong><?php echo $ordenCompra; ?></strong> por un total de <strong>$<?php echo number_format($montoPagado, 0, ',', '.'); ?></strong> ha sido procesada con éxito.</p>
                <p>Ya estamos preparando tus panes artesanales.</p>
                
                <script>localStorage.removeItem('carrito');</script>
                
                <a href="index.php" class="btn-volver">Volver al Inicio</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<h3>El pago fue rechazado por el banco (Código de respuesta: " . $response->getResponseCode() . ").</h3>";
        echo "<a href='carrito.php'>Intentar pagar otra vez</a>";
    }

} catch (\Exception $e) {
    echo "<h3>Error al confirmar la transacción:</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
}