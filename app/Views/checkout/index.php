<?= $this->extend('base') ?>
<?= $this->section('title') ?>
Checkout
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach(session('errors') as $error):?>
                <li><?= esc($error) ?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h2>Checkout</h2>
    <form action="<?= base_url('checkout/process') ?>" method="POST">
        <div class="row">
            <div class="col-md-4">
                <h4>Billing Information</h4>
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="shipping_address">Shipping Address</label>
                    <input type="text" name="shipping_address" id="shipping_address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select name="payment_method" id="payment_method" class="form-control">
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <h4>Order Summary</h4>
                <ul class="list-group mb-3">
                    <?php foreach ($cart_items as $item): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?= $item['name'] ?>(x<?= $item['quantity'] ?>)</span>
                            <strong>$<?= $item['total'] ?></strong>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>$<?= $item['total'] ?></strong>
                    </li>
                </ul>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
    </form>
</div>

<?= $this->endSection() ?>