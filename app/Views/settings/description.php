<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<?= session()->getFlashdata('errors') ? implode('<br>', session()->getFlashdata('errors')) : ''; ?>


<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h2 class="text-center">Add Category and Attribute</h2>

    <!-- List of Categories -->
    <h3>Categories</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['name'] ?></td>
                    <td>
                        <a href="<?= base_url('settings/edit-category/' . $category['category_id']) ?>" class="btn btn-warning">Edit</a>
                        <form action="<?= base_url('settings/delete-category/' . $category['category_id']) ?>" method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <!-- List of Attributes -->
    <h3>Attributes</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attributes as $attribute): ?>
                <tr>
                    <td><?= $attribute['name'] ?></td>
                    <td>
                        <a href="<?= base_url('settings/edit-attribute/' . $attribute['attribute_id']) ?>" class="btn btn-warning">Edit</a>
                        <form action="<?= base_url('settings/delete-attribute/' . $attribute['attribute_id']) ?>" method="post" style="display:inline-block;" onsumit="return confirm('Are you sure want to delete this attribute?');">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Category From -->

    <form action="<?= base_url('settings/add-category') ?>" method="POST">
        <div class="form-group mb-3">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>

    <!-- Attribute Form -->

    <form action="<?= base_url('settings/add-attribute') ?>" method="POST">
        <div class="form-group mb-3">
            <label for="attribute_name">Attribute Name</label>
            <input type="text" name="attribute_name" id="" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Attribute</button>
    </form>

</div>

<?= $this->endSection() ?>