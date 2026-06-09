<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'conexion.php';

use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\WebpayPlus;

$baserurl = "http://localhost/panaderia/pagar.php";


$config = WebpayPlus::configureForTesting();

$action = isset($_GET['action']) ? $_GET['action'] : 'init';

switch ($action) {
    case 'init':
        $total = isset($_GET['total']) ? intval($_GET['total']) : 0;
        $buy_order = "orden_" . rand();
        $session_id = "sesion_" . rand();
        $amount = $total;
        $return_url = $baserurl . "?action=getResult";
        $tx = new Transaction($config);
        $response = $tx->create($buy_order, $session_id, $amount, $return_url);
        header("Location: " . $response->getUrl() . "?token_ws=" . $response->getToken());
        exit;
    case 'getResult':
        $token = $_GET['token_ws'] ?? null;
        if (!$token) {
            header("Location: retornopagina.php");
        }
        $tx = new Transaction($config);
        $response = $tx->commit($token);
        if ($response && isset($response->status) && $response->status === 'AUTHORIZED') {
            header("Location: exitocompra.php");
            $buyOrderRaw = $response->getBuyOrder();
            $buyOrderClean = preg_replace('/\D/', '', $buyOrderRaw);
            $id = $buyOrderClean;
            $orden_compra = $buyOrderRaw;
            $monto = $response->getAmount();
            $fecha = $response->getTransactionDate();
            $stmt = $conexion->prepare("INSERT INTO pedidos (id, orden_compra, monto, fecha) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $id, $orden_compra, $monto, $fecha);
            $stmt->execute();
            $stmt->close();
        } else {
            header("Location: retornopagina.php");
            exit;
        }
}