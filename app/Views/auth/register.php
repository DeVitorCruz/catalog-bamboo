<?= $this->extend('base') ?>
<?= $this->section('title') ?>
Register
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Register</h2>
    <form action="<?= base_url('auth/register') ?>" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="username" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirm Password:</label>
            <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<?= $this->endSection() ?>

<?php $isLoginPage = false; // This will ensure the login link is shown 
?>