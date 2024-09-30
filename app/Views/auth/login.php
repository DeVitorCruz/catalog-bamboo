<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Login
<?= $this->endSection()  ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<div class="container">
    <h2>Login</h2>
    <form action="<?= base_url('auth/login'); ?>" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?= $this->endSection() ?>
<?php $isLoginPage = true; // This will be used in the base.php 
?>