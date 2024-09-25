<!-- app/Views/settings/edit_attribute.php -->

<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Edit Attribute</h2>
    <form action="<?= base_url('settings/update-attribute/' . $attribute['attribute_id']) ?>" method="post">
        <div class="form-group">
            <label for="attribute_name">Attribute name</label>
            <input type="text" name="attribute_name" id="attribute_name" class="form-control" value="<?= $attribute['name'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Attribute</button>
        <a role="button" class="btn btn-secondary mt-3" href="<?= base_url('/settings/description') ?>">Cancel</a>
    </form>
</div>

<?= $this->endSection() ?>