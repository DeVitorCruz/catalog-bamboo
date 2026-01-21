<?= $this->extend('base') ?>
<?= $this->section('title') ?>
My Wishlist
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wishlist as $item): ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td>
                        <a href="wishlist/remove/<?= $item['wishlist_id'] ?>" class="btn btn-danger btn-sm">Remove</a>
                        <a href="wishlist/add/<?= $item['wishlist_id'] ?>" class="btn btn-primary btn-sm">Move to Cart</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>