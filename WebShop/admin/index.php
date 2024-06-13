<?php
session_start();
require '../db_connect/get_products.php';
require '../db_connect/db_connection.php';
require '../shared/header.php';

$products = get_products_from_db();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>WebShop | Admin </title>
</head>
<body>
    <div class="container mt-5">
        <h2>Products</h2>
        <a href="add_product.php" class="btn btn-success mb-3">Add Product</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Цена</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($products)) {
                    foreach ($products as $id => $product) {
                        echo "<tr>";
                        echo "<td><img src='" . htmlspecialchars($product['img_url']) . "' alt='" . htmlspecialchars($product['title']) . "' style='width: 64px; height: 64px;'></td>";
                        echo "<td>" . htmlspecialchars($product['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['price']) . " ₽</td>";
                        echo "<td>
                                <a href='edit_product.php?id=" . $id . "' class='btn btn-primary'>Edit</a>
                                <a href='delete_product.php?id=" . $id . "' class='btn btn-danger'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
