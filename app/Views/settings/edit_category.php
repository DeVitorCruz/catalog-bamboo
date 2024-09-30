<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Settings
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Edit Category</h2>
    <form action="<?= base_url('settings/update-category/' . $category['category_id']) ?>" method="post">
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="<?= $category['name'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Category</button>
        <a type="button" class="btn btn-secondary mt-3" href="<?= base_url('/settings/description') ?>">Cancel</a>
    </form>
</div>

<?= $this->endSection() ?>