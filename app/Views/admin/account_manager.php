<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Profile Edit
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Check for success message -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- Check for error message -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Prodile Settings</div>
                    <ul class="list-group list-group-flush">
                        <?php if (session()->get('role') === 'customer'): ?>
                            <li class="list-group-item"><a href="#">Edit Profile</a></li>
                            <li class="list-group-item"><a href="<?= base_url('orders/history') ?>">Order History</a></li>
                            <li class="list-group-item"><a href="<?= base_url('wishlist') ?>">Wishlist</a></li>
                            <li class="list-group-item"><a href="<?= base_url('profile/updatePassword') ?>">Change Password</a></li>
                            <li class="list-group-item"><a href="<?= base_url('product') ?>">Manage Products</a></li>
                        <?php else: ?>
                            <li class="list-group-item"><a href="#">Edit Profile</a></li>
                            <li class="list-group-item"><a href="<?= base_url('admin/user-management') ?>">Manage Users</a></li>
                            <li class="list-group-item"><a href="<?= base_url('admin/order-management') ?>">Manage Orders</a></li>
                        <?php endif; ?>
                        <li class="list-group-item"><a href="<?= base_url('logout') ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tile">Edit Profile</h4>
                    <form action="" id="profileForm">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $user['username']; ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email address</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $user['email']; ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#profileForm').on('submit', function(e) {
        e.preventDefault();

        let formData = {
            username: $('#username').val(),
            email: $('#email').val()
        };

        $.ajax({
            url: '<?= base_url('profile/update') ?>',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert('Profile updated successfully!');
            },
            error: function(xhr) {
                alert("Something went wrong. Please try again.");
            }
        });
    });
</script>

<?= $this->endSection() ?>