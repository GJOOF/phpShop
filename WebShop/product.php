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
    <div id="product-details">
        <?php
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $productId = (int)$_GET['id'];
            $sql = "SELECT title, description, price, img_url FROM products WHERE id = :id";
            
            try {
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
                $stmt->execute();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product) {
                    echo "<img src='" . htmlspecialchars($product['img_url']) . "' alt='" . htmlspecialchars($product['title']) . "'>";
                    echo "<div id='product-info'>";
                    echo "<p><b>" . htmlspecialchars($product['title']) . "</b></p>";
                    echo "<p><b>" . htmlspecialchars($product['price']) . " ₽</b></p>";
                    echo "<p>" . htmlspecialchars($product['description']) . "</p>";
                    echo "<div class='product-buttons'>";
                    echo "<a href='checkout.php?id=" . $productId . "'>Оформить заказ</a>";
                    echo "<a href='catalog.php' class='continue-shopping'>Продолжить покупки</a>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<p>Product not found!</p>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "<p>Invalid product ID!</p>";
        }
        ?>
    </div>
</body>
</html>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #product-details {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            display: flex;
            align-items: flex-start;
        }

        #product-details img {
            max-width: 300px;
            height: auto;
            border: solid 2px #ccc;
            margin-right: 20px;
        }

        #product-info {
            max-width: 600px;
        }

        #product-info p {
            font-size: 18px;
            color: #333;
            margin: 5px 0;
        }

        #product-info p b {
            color: #000;
            font-size: 22px;
        }

        .product-buttons {
            display: flex;
            margin-top: 20px;
        }

        .product-buttons a, .product-buttons button {
            text-decoration: none;
            background-color: #ff4081;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .product-buttons a:hover, .product-buttons button:hover {
            background-color: #ff1c63;
        }

        .product-buttons .continue-shopping {
            background-color: #007BFF;
        }

        .product-buttons .continue-shopping:hover {
            background-color: #0056b3;
        }
    </style>
<?php require 'shared/footer.php'; ?>
