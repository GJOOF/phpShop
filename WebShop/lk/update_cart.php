<?php
session_start();

$productId = $_POST['id'];
$action = $_POST['action'];

if (!isset($_SESSION['cart'][$productId])) {
    die(json_encode(['error' => 'Product not found in cart']));
}

if ($action === 'increase') {
    $_SESSION['cart'][$productId]++;
} elseif ($action === 'decrease') {
    if ($_SESSION['cart'][$productId] > 1) {
        $_SESSION['cart'][$productId]--;
    } else {
        unset($_SESSION['cart'][$productId]);
    }
}

echo json_encode(['success' => true]);
?>
