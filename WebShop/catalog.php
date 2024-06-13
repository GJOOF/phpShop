<?php 
require 'shared/header.php';
require 'shared/footer.php';
require 'db_connect/get_products.php';
require 'db_connect/db_connection.php';

$products = get_products_from_db();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="css/style.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/site.js"></script>

</head>
<body>

<!-- <div class="container">
    <div class="sidebar">
        <h3>Поиск по каталогу</h3>
        <input type="text" placeholder="например, Michael Jackson" />
        <input type="text" placeholder="например, Thriller" />
        <input type="number" placeholder="от" min="0"/>
        <input type="number" placeholder="до" min="0"/>
        <select>
            <option>нажмите для выбора</option>
        </select>
        <select>
            <option>нажмите для выбора</option>
        </select>
        <select>
            <option>нажмите для выбора</option>
        </select>
        <button class="catalog_search_button">Искать по каталогу</button>
    </div> -->
<div class="content-inner"  style="margin: 20px 100px 50px">
<div class="main-content">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Каталог</li>
    </ol>
</nav>
<h2>Каталог</h2>
<div class="product-list" ><?php foreach ($products as $product): ?>
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
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
        
            <div class="product-item" style=" width: calc(100% / 4 - 20px)" data-id="<?= $product['id'] ?>">
                <img src="<?php echo htmlspecialchars($product['img_url']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" style="border:solid 2px">
                <p><?php echo htmlspecialchars($product['title']); ?></p>
                <p><b><?php echo htmlspecialchars($product['price']); ?> ₽</b>
                <a class="cart-button fa-solid fa-cart-shopping" id="card-button" data-id="<?= $product['id'] ?>" href="checkout.php?id=<?= $product['id'] ?>"></a></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
</body>
</html>
