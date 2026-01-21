<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>

<?= $this->section('announcementBar') ?>

<style>
    .announcement-bar {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px 0;
        overflow: hidden;
        position: relative;
        width: 100%;
        white-space: nowrap;
        border-bottom: 1px solid #f5c6cb;
    }

    .announcement-content {
        display: inline-block;
        padding-left: 100%;
        animation: scrollLeftToRight 20s linear infinite;
    }

    .announcement-item {
        margin-right: 50px;
        display: inline-block;
        font-size: 16px;
        font-weight: bold;
    }

    @keyframes scrollLeftToRight {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }
</style>

<nav class="nav">
    <div class="announcement-bar">
        <div class="announcement-content">
            <?php foreach ($announces as $announce): ?>
                <span class="announcement-item"><?= $announce['message']; ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<?= $this->endSection() ?>

<?= $this->section('banner') ?>

<style>
    .carousel-item img {
        height: 600px;
        object-fit: cover;
    }

    .carousel-caption {
        position: absolute;
        top: 56%;
        transform: translateY(-50%);
        left: 15%;
        text-align: center;
    }

    .carousel-caption h2 {
        font-size: 3rem;
        font-weight: bold;
    }

    .carousel-captopn p {
        font-size: 1.25rem;
    }

    @media only screen and (max-width: 768px) {
        .carousel-captio h2 {
            font-size: 2rem;
        }

        .carousel-caption p {
            font-size: 1rem;
        }

        .carousel-caption a {
            font-size: .9rem;
        }
    }
</style>

<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" aria-label="Slide 1" aria-current="true" class="active"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="https://images.pexels.com/photos/28680370/pexels-photo-28680370/free-photo-of-cozy-coffee-cup-and-backgammon-on-persian-rug.jpeg" alt="Banner 1" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h5>Featured Products</h5>
                <p>Discover our best-selling products and exclusive offers.</p>
                <a href="#" class="btn btn-primary">Shop Now</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://images.pexels.com/photos/28818953/pexels-photo-28818953/free-photo-of-charming-cafe-exterior-with-vintage-signage.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Banner 2" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h5>New Arrivals</h5>
                <p>Check out the latest trends in fashion and accessories.</p>
                <a href="#" class="btn btn-primary">Explore Collection</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://images.pexels.com/photos/27916602/pexels-photo-27916602/free-photo-of-a-man-on-a-motorcycle-is-sitting-in-the-middle-of-a-street.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Banner 3" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
                <h5>Special Deals</h5>
                <p>Exclusive discounts on selected products for a limited time.</p>
                <a href="#" class="btn btn-primary">Get Discount</a>
            </div>
        </div>

        <button type="button" class="carousel-control-prev" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button type="button" class="carousel-control-next" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center">Welcome to Our Ecommerce Store</h1>
    <p class="text-center">Explore our amazing products!</p>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($product['name']) ?></h5>
                        <p class="card-text"><?= esc($product['description']) ?></p>
                        <p class="card-text">Price: $<?= esc($product['price']) ?></p>
                        <p class="card-text">Stock: <?= esc($product['stock']) ?></p>
                        <form action="<?= base_url('cart/add') ?>" method="POST">
                            <input type="hidden" name="product_id" id="product_id" value="<?= $product['product_id'] ?>">
                            <input type="hidden" name="price" id="price" value="<?= esc($product['price']) ?>">
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?= $product['stock'] ?>">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>