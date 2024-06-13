<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/85132e6ec1.js" crossorigin="anonymous"></script>
<link href="../css/style.css" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="../img/favicon.png">
<title>WebShop</title>
</head>
<header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
            <div class="container-fluid">
                <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                <a class="navbar-brand" href="../index.php">WebShop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                </button>
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../catalog.php">Каталог</a>
                        </li>
                        <div class="input-group">
                            <div class="form-outline" data-mdb-input-init style="width:90%">
                                <input type="search" name="query" id="search-bar" class="form-control" action="catalog.php" placeholder="Поиск по пластинкам" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../privacy.php">
                            <i class="fa-solid fa-shield-halved" style="margin-left: 15px"></i>Privacy
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../lk/deliveries.php">
                            <i class="fa-solid fa-truck" style="margin-left: 25px"></i>Доставка
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../admin/index.php">
                            <i class="fa-solid fa-user" style="margin-left: 15px"></i>Админ
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../lk/cart.php">
                            <i class="fa-solid fa-cart-shopping" style="margin-left: 5px"><span id="cart-count" class="notify"><?= array_sum($_SESSION['cart'] ?? []) ?></span></i>Cart
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    