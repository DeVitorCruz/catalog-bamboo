<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-center">Product Listing</h2>
        <a href="<?= base_url('product/create') ?>" class="btn btn-success">Add New Product</a>
    </div>

    <div class="row">
        <?php if (isset($products) && count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($product['name']) ?></h5>
                            <p class="card-text">Price: $<?= esc($product['price']) ?></p>
                            <button type="button" class="btn btn-primary view-detials" data-product-id="<?= $product['product_id'] ?>">View <Details></Details></button>
                            <td>
                                <a href="<?= base_url('product/edit/' . $product['product_id']) ?>" class="btn btn-warning">Edit</a>
                                <form action="<?= base_url('product/delete/' . $product['product_id']) ?>" method="post" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No products found</p>
        <?php endif; ?>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="moal-header">
                    <h5 class="modal-title" id="productDetailsModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="" alt="Product Image" id="productImage" class="img-fluid mb-3" style="max-height: 300px;">
                    </div>
                    <h5 id="productName"></h5>
                    <p id="productDescription"></p>
                    <h6>Price: $<span id="productPrice"></span></h6>
                    <h6>Stock: <span id="productStock"></span></h6>
                    <h6>Category: <span id="productCategory"></span></h6>
                    <h6>Attributes:</h6>
                    <ul id="productAttributes"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <a type="button" class="btn btn-secondary" href="<?= base_url('/') ?>">Cancel</a>

</div>

<script>
    $(document).ready(function() {
        $('.view-detials').on('click', function() {
            // Get the product ID from the button

            const productId = $(this).data('product-id');

            // Perform an AJAX request to get the product details

            $.ajax({
                url: '<?= site_url('product/getProductDetails') ?>/' + productId,
                method: 'GET',
                success: function(response) {

                    // Fill modal with product details
                    $('#productImage').attr('src', response.product.image_url);
                    $('#productName').text(response.product.name);
                    $('#productDescription').text(response.product.description);
                    $('#productPrice').text(response.product.price);
                    $('#productStock').text(response.product.stock);
                    $('#productCategory').text(response.category.name);

                    // Populate the attributes

                    $('#productAttributes').empty();
                    response.attributes.forEach(function(attribute) {
                        $('#productAttributes').append(`<li>${attribute.name}: ${attribute.value}</li>`);
                    });

                    // Open the modal
                    $('#productDetailsModal').modal('show');

                },
                error: function(xhr, status, error) {
                    console.error(`An error occurred: ${error}`);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>