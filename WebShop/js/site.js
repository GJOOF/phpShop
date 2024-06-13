document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.product-item');
    items.forEach(item => {
        item.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            window.location.href = 'product.php?id=' + productId;
        });
    });
});