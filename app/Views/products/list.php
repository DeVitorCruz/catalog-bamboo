<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Product List
<?= $this->endSection()  ?>

<style>
    .price-range-slider {
        padding: 10px;
    }

    .price-range-slider input[type="range"] {
        width: 100%;
    }

    .price-range-slider span {
        font-weight: bold;
    }
</style>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-center">Product Listing</h2>
        <a href="<?= base_url('product/create') ?>" class="btn btn-success">Add New Product</a>
    </div>

    <div class="container-fuild">
        <div class="row">
            <!-- Sidebar for Filter -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Products</h5>
                    </div>
                    <div class="card-body">
                        <!-- Category Filter -->
                        <h6>Category <button class="btn btn-sm btn-toggle" onclick="toggleSection('categoryFilter');">Hide</button></h6>
                        <div id="categoryFilter">
                            <?php foreach ($categories as $category): ?>
                                <div class="form-check">
                                    <input type="checkbox" name="categories[]" id="category<?= $category['category_id'] ?>" class="form-check-input" value="<?= $category['category_id'] ?>">
                                    <label for="category<?= $category['category_id'] ?>" class="form-check-label"><?= $category['name'] ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Attribute Filter -->
                        <h6 class="mt-3">Attributes <button class="btn btn-sm btn-toggle" onclick="toggleSection('attributeFilter')">Hide</button></h6>
                        <div id="attributeFilter">
                            <?php foreach ($attributes as $attribute): ?>
                                <div class="form-check">
                                    <input type="checkbox" name="attributes[]" id="attribute<?= $attribute['attribute_id'] ?>" class="form-check-input" value="<?= $attribute['attribute_id'] ?>">
                                    <label for="attribute<?= $attribute['name'] ?>" class="form-check-label"><?= $attribute['name'] ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="price-range-slider mt-3">
                            <h6>Price Range</h6>
                            <div class="form-group">
                                <label for="minPrice">Min Price</label>
                                <input type="number" id="minPrice" class="form-control" placeholder="Min">
                            </div>
                            <div class="form-group">
                                <label for="maxPrice">Max Price</label>
                                <input type="number" name="" id="maxPrice" class="form-control" placeholder="Max">
                            </div>
                        </div>

                        <div class="price-filter">
                            <h5>Price Range</h5>
                            <div id="price-range"></div>
                            <div class="price-values">
                                <span>Min: $<span id="min-price"></span></span>
                                <span>Max: $<span id="max-price"></span></span>
                            </div>
                        </div>


                        <!-- Filter Button -->
                        <button class="btn btn-primary mt-3" id="applyFilter">Apply Filters</button>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row" id="productGrid">
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
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="moal-header">
                    <h5 class="modal-title" id="productDetailsModalLabel">Product Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <a type="button" class="btn btn-secondary" href="<?= base_url('/') ?>">Cancel</a>

</div>

<script>
    function toggleSection(sectionId) {
        const section = $(`#${sectionId}`);

        if (section.css('display') === 'none') {
            section.css('display', 'block');
        } else {
            section.css('display', 'none');
        }
    }
</script>

<script>
    $(document).on('click', '.view-detials', function() {
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
</script>

<script>
    $('#applyFilter').on('click', function() {
        // Get selected categories
        const categories = $('input[name="categories[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        // Get selected attributes
        const attributes = $('input[name="attributes[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        // Get the price range values
        const minPrice = $('#minPrice').val();
        const maxPrice = $('#maxPrice').val();

        // Send AJAX request to apply filters
        $.ajax({
            url: '<?= site_url('product/filter') ?>', // Adjust the URL to match your route
            type: 'POST',
            data: {
                categories: categories,
                attributes: attributes,
                minPrice: minPrice,
                maxPrice: maxPrice
            },
            success: function(products) {
                // Clear the current product grid
                $('#productGrid').html('');

                // Iterate over the filtered products and append them to the grid

                $.each(products, function(index, product) {
                    let baseUrl = "<?= base_url(); ?>";

                    $('#productGrid').append(`
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="${product.image_url}" class="card-img-top" alt="${product.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${product.name}</h5>
                                    <p class="card-text">Price: $${product.price}</p>
                                    <button type="button" class="btn btn-primary view-detials" data-product-id="${product.product_id}">View <Details></Details></button>
                                    <td>
                                        <a href="${baseUrl}product/edit/${product.product_id}" class="btn btn-warning">Edit</a>
                                        <form action="${baseUrl}product/delete/${product.product_id}" method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </div>
                            </div>
                        </div>
                    `);
                });
            }
        });

    });
</script>

<script>
    <?php
    $minPrice = min(array_column($products, 'price'));
    $maxPrice = max(array_column($products, 'price'));
    ?>

    let minPrice = <?= $minPrice; ?>;
    let maxPrice = <?= $maxPrice; ?>;

    // Initialize noUiSlider

    const priceSlider = document.getElementById('price-range');

    noUiSlider.create(priceSlider, {
        start: [minPrice, maxPrice],
        connect: true,
        range: {
            'min': minPrice,
            'max': maxPrice
        },
        step: 1,
        tooltips: [true, true],
        format: {
            to: function(value) {
                return Math.round(value);
            },
            from: function(value) {
                return Number(value);
            }
        }
    });

    // Display initial min and max prices in the UI
    let minPriceInput = document.getElementById('min-price');
    let maxPriceInput = document.getElementById('max-price');

    priceSlider.noUiSlider.on('update', function(values) {
        minPriceInput.innerHTML = values[0];
        maxPriceInput.innerHTML = values[1];
    });

    // On slider change, trigger product filtering
    priceSlider.noUiSlider.on('change', function(values) {
        let minPrice = values[0];
        let maxPrice = values[1];
        filterProductsByPrice(minPrice, maxPrice);
    });

    function filterProductsByPrice(minPrice, maxPrice) {
        $.ajax({
            url: '<?= base_url('product/filter-slider') ?>',
            method: 'GET',
            data: {
                min_price: minPrice,
                max_price: maxPrice
            },
            success: function(products) {
                // Assuming the products contains the updated product grid
                $('#productGrid').html('');

                $.each(products, function(index, product) {
                    let baseUrl = "<?= base_url(); ?>";

                    $('#productGrid').append(`
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="${product.image_url}" class="card-img-top" alt="${product.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${product.name}</h5>
                                    <p class="card-text">Price: $${product.price}</p>
                                    <button type="button" class="btn btn-primary view-detials" data-product-id="${product.product_id}">View <Details></Details></button>
                                    <td>
                                        <a href="${baseUrl}product/edit/${product.product_id}" class="btn btn-warning">Edit</a>
                                        <form action="${baseUrl}product/delete/${product.product_id}" method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </div>
                            </div>
                        </div>
                    `);
                });

            },
            error: function() {
                console.error('Error filtering products.');
            }
        });
    }
</script>

<?= $this->endSection() ?>