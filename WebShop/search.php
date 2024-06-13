<?php
require 'shared/header.php';
require 'db_connect/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div id="catalog">
        <form action="catalog.php" method="GET">
            <input type="text" name="query" placeholder="Поиск товаров...">
            <button type="submit">Поиск</button>
        </form>
        
        <div id="product-list">
            <?php
            if (isset($_GET['query'])) {
                $searchQuery = htmlspecialchars($_GET['query']);
                $sql = "SELECT id, title, price, img_url FROM products WHERE title LIKE :query";
                $stmt = $conn->prepare($sql);
                $searchTerm = '%' . $searchQuery . '%';
                $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);
            } else {
                $sql = "SELECT id, title, price, img_url FROM products";
                $stmt = $conn->prepare($sql);
            }

            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($products) {
                foreach ($products as $product) {
                    echo "<div class='product-item'>";
                    echo "<a href='product.php?id=" . htmlspecialchars($product['id']) . "'>";
                    echo "<img src='" . htmlspecialchars($product['img_url']) . "' alt='" . htmlspecialchars($product['title']) . "'>";
                    echo "<p>" . htmlspecialchars($product['title']) . "</p>";
                    echo "<p><b>" . htmlspecialchars($product['price']) . " ₽</b></p>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No products found!</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php require 'shared/footer.php'; ?>
