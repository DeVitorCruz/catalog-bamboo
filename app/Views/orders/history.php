<?= $this->extend('base') ?>
<?= $this->section('title') ?>
Order History
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Your Order History</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?= $order['order_id'] ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <td><?= $order['total_items'] ?> items</td>
                    <td>$<?= $order['total_price'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td><a href="/orders/<?= $order['order_id'] ?>" class="btn btn-info btn-sm"></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>