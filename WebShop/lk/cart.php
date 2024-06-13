<?php 
session_start();
require '../shared/header.php'; 
require '../db_connect/get_products.php';

$products = get_products_from_db();
$cart_items = $_SESSION['cart'] ?? [];
$total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="text-center">
    <div class="cart-items">
    <?php if (empty($cart_items)): ?>
        <h2>Корзина пуста</h2>
    <?php else: ?>
        <h1>Корзина</h1>
        <table class="table">
            <tr>
                <th>Альбом</th>
                <th>Цена, руб</th>
                <th>Кол-во копий</th>
                <th>Стоимость, руб</th>
            </tr>
            <?php foreach ($cart_items as $id => $quantity): 
                $product = $products[$id];
                $item_price = $product['price'];
                $total_price += $product['price'] * $quantity;
                ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($product['img_url']); ?>" alt="<?= htmlspecialchars($product['title']); ?>"style="width 64px; height:64px"><?= htmlspecialchars($product['title']); ?></td>
                    <td><?= $item_price ?></td>
                    <td><?= $quantity ?></td>
                    <td>Цена: <?= $item_price * $quantity?></td>
                    <td><p>
                        <button data-id="<?= $id ?>" data-action="increase" class="quantity-button">+</button>
                        <button data-id="<?= $id ?>" data-action="decrease" class="quantity-button">-</button>
                    </p></td>
                </tr>
                <?php endforeach; ?>
        </table>
        <h3>Общая стоимость: <?= $total_price ?> руб.</h3>
        <button class="checkout-button" >Оформить заказ</button>
    <?php endif; ?>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.quantity-button').click(function() {
        var productId = $(this).data('id');
        var action = $(this).data('action');
        
        $.post('update_cart.php', { id: productId, action: action }, function(data) {
            location.reload();
        }, 'json');
    });
});
</script>
<style>
.quantity-button {
    background: #333;
    color: #fff;
    border: 0;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}
.quantity-button:hover {
    background: #555;
}
</style>
</body>
</html>
<?php require '../shared/footer.php'; ?>
