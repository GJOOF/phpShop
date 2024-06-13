<?php
session_start();
require 'db_connect/get_products.php';

$productId = $_GET['id'];
$products = get_products_from_db();

if (!isset($products[$productId])) {
    die('Продукт не найден');
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId] = 0;
}

$_SESSION['cart'][$productId]++;

header('Location: lk/cart.php');
exit;
?>
