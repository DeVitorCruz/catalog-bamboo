<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Edit
<?= $this->endSection()?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-center">Edit Product</h2>
        <a href="<?= base_url('/') ?>" class="btn btn-primary">Back to Home</a>
    </div>

    <form action="<?= base_url('product/update/') . $product['product_id'] ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?> <!-- CSRF Token -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= esc($product['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Product Description:</label>
            <textarea name="description" id="description" class="form-control"><?= esc($product['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="text" name="price" id="price" value="<?= esc($product['price']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock Quantity:</label>
            <input type="number" name="stock" id="stock" class="form-control" value="<?= esc($product['stock']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">Product Image URL:</label>
            <input type="url" name="image_url" id="image_url" class="form-control" value="<?= esc($product['image_url']) ?>">
        </div>

        <!-- Category Selection -->

        <div class="mb-3">
            <label for="category" class="form-label">Select Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Select a category</option>
                <!-- Loop through categories -->
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['category_id'] ?>" <?= $category['category_id'] == $currentCategory['category_id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Attributes (related to the select category) -->
        <div id="attributeInputs">
            <div class="mb-3">
                <?php foreach ($attributes as $attribute): ?>
                    <?php
                    // Find the curren attribute value for this attribute_id
                    $currentValue = '';

                    foreach ($currentAttributes as $currentAttribute) {
                        if ($currentAttribute['attribute_id'] == $attribute['attribute_id']) {
                            $currentValue = $currentAttribute['value'];
                            break;
                        }
                    }
                    ?>
                    <label for="${attribute.attribute_id}" class="form-group"><?= $attribute['name']; ?></label>
                    <input
                        type="text"
                        class="form-control"
                        name="attribute_values[<?= $attribute['attribute_id'] ?>][value]"
                        id="attribute_values[<?= $attribute['attribute_id'] ?>][value]"
                        placeholder="Enter <?= $attribute['name']; ?>"
                        value="<?= esc($currentValue); ?>" required>
                    <input type="hidden" name="attribute_values[<?= $attribute['attribute_id'] ?>][attribute_id]" value="<?= $attribute['attribute_id'] ?? ''; ?>">
                <?php endforeach; ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a type="button" class="btn btn-secondary" href="<?= base_url('/product') ?>">Cancel</a>

    </form>

</div>

<script>
    $('#category_id').change(function() {
        const categoryId = $(this).val();

        // Clear previous attributes inputs
        $("#attributeInputs").empty();

        // Send AJAX request to get the attributes for the selected category

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
                                    name="attribute_values[${attribute.attribute_id}][value]" 
                                    id="attribute_values[${attribute.attribute_id}][value]" 
                                    placeholder="Enter ${attribute.name}" required
                                >
                                <input type="hidden" name="attribute_values[${attribute.attribute_id}][attribute_id]" value="${attribute.attribute_id}">
                            </div>
                        `);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving attributes: ' + error);
            }
        });
    });
</script>

<?= $this->endSection() ?>