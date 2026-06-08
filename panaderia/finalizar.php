<?php
require_once 'vendor/autoload.php';
use Transbank\Webpay\WebpayPlus\Transaction;

$token = $_POST['token_ws'] ?? null;
if (!$token) {
    die("No se recibió el token de la transacción.");
}

$transaction = new Transaction();
$response = $transaction->commit($token);

if ($response->isApproved()) {
    echo "<h1>¡Pago Exitoso en Olivia's Panadería!</h1>";
    echo "<p>Orden de compra: " . $response->getBuyOrder() . "</p>";
    echo "<a href='index.html'>Volver al inicio</a>";
    echo "<script>localStorage.removeItem('carrito');</script>";
} else {
    echo "<h1>El pago fue rechazado o cancelado.</h1>";
    echo "<a href='carrito.html'>Reintentar pago</a>";
}