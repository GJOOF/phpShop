<?php
session_start();
require '../db_connect/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img_url = $_POST['img_url'];

    $sql = "INSERT INTO products (title, description, price, img_url) VALUES (:title, :description, :price, :img_url)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img_url', $img_url);
    $stmt->execute();
    if(!isset($_POST['img_url']) && !empty($_POST['img_url'])){
        $img_url = $_POST['img_url'];
    } else {
        $img_url = "../img/base.jpg";
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> WebShop | Add product </title>
</head>
<body>
    <div class="container mt-5">
        <h2>Add Product</h2>
        <form method="post" action="add_product.php">
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" min="1" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="img_file" class="form-label">Ссылка на изображение</label>
                <input type="file" class="form-control" id="img_file" name="img_file" accept=".jpg, .jpeg, .png">
                <input type="hidden" name="img_url" value="<?= htmlspecialchars($product['img_url']) ?>">
            </div>
            <button type="submit" class="btn btn-success">Add Product</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
