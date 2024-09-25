<!-- app/Views/settings/link_category_attribue.php -->

<?= $this->extend('base') ?>
<?= $this->section('content') ?>


<div class="container mt-5">
    <h2>Assign Attributes to a Category</h2>

    <form action="<?= base_url('settings/saveAttributes') ?>" method="post">
        <div class="form-group">
            <label for="category">Select Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= esc($category['category_id']) ?>">
                        <?= esc($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="attributes">Select Attributes</label>
            <select name="attribute_ids[]" id="attribute_ids" class="form-control" multiple>
                <?php foreach ($attributes as $attribute): ?>
                    <option value="<?= $attribute['attribute_id'] ?>">
                        <?= esc($attribute['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="<?= base_url('/settings/description') ?>" role="button" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

<script>
    $('#category_id').on('change', function() {
        const category_id = $(this).val();
        fetchAttributesForCategory(category_id);
    });

    function fetchAttributesForCategory(category_id) {
        if (!category_id) {
            $('#attribute_ids option').prop('disabled', false); // Re-enable all options if no category is selected
            return;
        }

        $.ajax({
            url: '<?= site_url('settings/getAttributesByCategory'); ?>/' + category_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const selectedAttributes = data.map(item => parseInt(item.attribute_id));
                $('#attribute_ids option').each(function() {
                    const optionValue = parseInt($(this).val());
                    $(this).prop('disabled', selectedAttributes.includes(optionValue));
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching attributes', error);
            }
        });

    }
</script>

<script>
    $(document).ready(function() {
        // Apply Select2 to the attribute select dropdown
        $('#attribute_ids').select2({
            placeholder: "Select attributes",
            allowClear: true
        });
    });
</script>


<?= $this->endSection(); ?>