<?php
include 'db_connection.php';

function get_products_from_db() {
    global $conn;
    try {
        $stmt = $conn->query("SELECT id, title, img_url, price FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    } catch(PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
        return [];
    }
}
?>
