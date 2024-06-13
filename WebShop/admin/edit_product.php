<?php
session_start();
require '../db_connect/db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid product ID');
}

$productId = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img_url = $_POST['img_url'];

    if (isset($_FILES['img_file']) && $_FILES['img_file']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["img_file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["img_file"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_file)) {
                $img_url = $target_file;
            } else {
                die('Error uploading file.');
            }
        } else {
            die('File is not an image.');
        }
    }

    $sql = "UPDATE products SET title = :title, description = :description, price = :price, img_url = :img_url WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img_url', $img_url);
    $stmt->bindParam(':id', $productId);
    $stmt->execute();

    header("Location: index.php");
    exit;
} else {
    $sql = "SELECT title, description, price, img_url FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $productId);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die('Product not found');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>WebShop | Edit product </title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form method="post" action="edit_product.php?id=<?= htmlspecialchars($productId) ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($product['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($product['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" min="1" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="img_file" class="form-label">Ссылка на изображение</label>
                <input type="file" class="form-control" id="img_file" name="img_file" accept=".jpg, .jpeg, .png">
                <input type="hidden" name="img_url" value="<?= htmlspecialchars($product['img_url']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
