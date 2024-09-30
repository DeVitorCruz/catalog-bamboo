<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Cadastrate
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Display Success or Error Messages -->

<?php if (session()->has('message')): ?>
    <div class="alert alert-success">
        <?= session('message') ?>
    </div>
<?php endif; ?>

<?php if (isset($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Product Registration From -->
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-center">Add New Product</h2>
        <a href="<?= base_url('/') ?>" class="btn btn-primary">Back to Home</a>
    </div>
    <form action="<?= base_url('/product/store') ?>" method="post">
        <?= csrf_field() ?> <!-- CSRF Token -->

        <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= old('name') ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Product Description:</label>
            <textarea name="description" id="description" class="form-control"><?= old('description') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="text" name="price" id="price" value="<?= old('price') ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock Quantity:</label>
            <input type="number" name="stock" id="stock" class="form-control" value="<?= old('stock') ?>" required>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">Product Image URL:</label>
            <input type="url" name="image_url" id="image_url" class="form-control" value="<?= old('image_url') ?>">
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Select Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Select a category</option>
                <!-- Loop through categories -->
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="attributeInputs"></div>

        <button type="submit" class="btn btn-primary">Add Product</button>
        <a type="button" class="btn btn-secondary" href="<?= base_url('/product') ?>">Cancel</a>
    </form>
</div>

<script>
    $('#category_id').change(function() {
        const categoryId = $(this).val();

        // Clear previous attributes inputs
        $("#attributeInputs").empty();

        // If a category is selected
        if (categoryId !== false) {
            $.ajax({
                url: '<?= site_url('product/getAttributes') ?>/' + categoryId,
                method: 'GET',
                success: function(data) {

                    const attributes = data;

                    // Generate input fields for each attributes

                    attributes.forEach(function(attribute) {
                        $('#attributeInputs').append(`
                            <div class="mb-3">
                                <label for="${attribute.attribute_id}" class="form-group">${attribute.name}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="attribute_values[${attribute.attribute_id}]" 
                                    id="${attribute.attribute_id}" 
                                    placeholder="Enter ${attribute.name}">
                            </div>
                        `);
                    });
                }
            });
        }
    });
</script>

<?= $this->endSection() ?>