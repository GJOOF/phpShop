<?php
require '../shared/header.php';
require '../db_connect/db_connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = (int)$_GET['id'];

    // Удаление продукта из базы данных
    $sql = "DELETE FROM products WHERE id = :id";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid product ID!";
} 
?>

<?php require '../shared/footer.php'; ?>
