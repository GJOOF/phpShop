<?php include 'shared/header.php' ?>
<body>
<div id="carouselId" class="carousel slide" data-bs-ride="carousel" style=" padding-top: 20px; padding-bottom: 20px; margin: 0 5px 0 5px ">
    <div class="carousel-inner" role="listbox" style="border-radius: 15px;">
        <div class="carousel-item active">
            <img src="img/banner2.jpeg"
                 class="w-100 d-block"
                 alt="Second slide"
                 object-fit: cover; />
        </div>
        <div class="carousel-item">
            <img src="img/banner3.jpeg"
                 class="w-100 d-block"
                 alt="Third slide"
                 object-fit: cover; />
        </div>
    </div>
    <button class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselId"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next"
            type="button"
            data-bs-target="#carouselId"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</div>

<link href="../css/style.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
<?php include 'shared/footer.php' ?>