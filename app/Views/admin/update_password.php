<?= $this->extend('base') ?>
<?= $this->section('title') ?>
Update Password
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Password update form -->
<form action="<?= base_url('profile/updatePassword') ?>" method="post">
    <div class="form-group">
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" id="current_password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Password</button>
</form>



<?= $this->endSection() ?>