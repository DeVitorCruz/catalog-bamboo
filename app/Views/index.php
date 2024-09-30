<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center">Welcome to Our Ecommerce Store</h1>
    <p class="text-center">Explore our amazing products!</p>

    <div class="row">
        <div class="col-md-6 container mt-5">
            <div class="text-center">
                <a href="<?= base_url('product/create') ?>" class="btn btn-primary btn-lg">Cadastrate a Product</a>
            </div>
        </div>
        <div class="col-md-6 container mt-5">
            <div class="text-center">
                <a href="<?= base_url('product/') ?>" class="btn btn-success btn-lg">List of Product</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>