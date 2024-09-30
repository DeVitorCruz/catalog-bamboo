<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<table class="table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Stock Quantity</th>
            <th>Stock Threshold</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inventor as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['stock_quantity'] ?></td>
                <td><?= $item['stock_threshold'] ?></td>
                <td>
                    <a href="<?= base_url('admin/editStock/' . $item['product_id']) ?>" class="btn btn-primary">Update Stock</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>