<?= $this->extend('base'); ?>
<?= $this->section('title') ?>
Design
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Design Customization</h2>
    <p>Here you can customize the layout and design of your ecommerce platform.</p>
    <div class="row">
        <div class="col-md-6">
            <h4>Theme Colors</h4>
            <form action="">
                <div class="mb-3">
                    <label for="primaryColor" class="form-label">Primary Color</label>
                    <input type="color" name="primaryColor" id="primaryColor" class="form-control form-control-color" value="#007bff">
                </div>
                <div class="mb-3">
                    <label for="secondaryColor" class="form-label">Secondary Color</label>
                    <input type="color" name="secondaryColor" id="secondaryColor" class="form-control form-control-color" value="#6c757d">
                </div>
                <button type="submit" class="btn btn-primary">Save Colors</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Banner Management</h4>
            <form action="">
                <div class="mb-3">
                    <label for="bannerImage" class="form-label">Upload Banner</label>
                    <input type="file" name="bannerImage" id="bannerImage" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Upload Banner</button>
            </form>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <h4>Font Selector</h4>
            <form action="">
                <div class="mb-3">
                    <label for="fontFamily" class="form-label">Select Font</label>
                    <select name="fontFamily" id="fontFamily" class="form-select">
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier New">Courier New</option>
                        <option value="Roboto">Roboto</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save Font</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Layout Preview</h4>
            <div class="border p-3">
                <h5>Preview Area</h5>
                <p style="font-family: Arial;" id="previewText">This is how your text will look!</p>
                <div class="bg-primary text-white p-2">This is a preview of your primary color.</div>
                <div class="bg-secondary text-white p-2 mt-2">This is a preview of your secondary color.</div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h4>Announcements:</h4>
            <button class="btn btn-primary mb-3" id="createAnnouncementBtn">Create Announcement</button>
            <div class="mt-3">
                <h5>Current Announcements:</h5>
                <table id="announcementTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Message</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4>Banners:</h4>
            <button class="btn btn-primary mb-3" id="createBanner">Create Banner</button>
            <div class="mt-3">
                <h5>Current Banners:</h5>
                <table class="table table-bordered" id="bannersTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Active</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Announcement Modal -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="announcementModalLabel">Create New Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="announcementForm">
                        <input type="hidden" name="announcementId" id="announcementId">
                        <div class="mb-3">
                            <label for="message" class="form-label">Announcement Text</label>
                            <input type="text" name="message" id="message" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="announcementColor" class="form-label">Background Color</label>
                            <input type="color" name="announcementColor" id="announcementColor" class="form-control form-control-color" value="#ffdd57">
                        </div>
                        <div class="mb-3">
                            <label for="announcementDuration" class="form-label">Duration (seconds)</label>
                            <input type="number" name="announcementDuration" id="announcementDuration" class="form-control" value="10">
                        </div>
                        <div class="mb-3">
                            <label for="active" class="form-label">Active?</label>
                            <input type="checkbox" name="active" id="active">
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="saveButton" class="btn btn-primary">Save Announcement</button>
                        <button type="button" id="updateButton" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create a banner -->
    <div class="modal fade" id="bannerModal" tabindex="-1" aria-labelledby="bannerModalLabel" arai-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bannerModalLabel">Create/Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="bannerForm">
                    <div class="modal-body">
                        <input type="hidden" name="bannerId" id="bannerId">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="imageUrl" class="form-label">Image URL</label>
                            <input type="text" name="imageUrl" id="imageUrl" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="linkUrl" class="form-label">Link URL</label>
                            <input type="text" name="linkUrl" id="linkUrl" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="activeBanner" class="form-label">Active?</label>
                            <input type="checkbox" name="activeBanner" id="activeBanner">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="saveBanner" class="btn btn-primary">Save</button>
                        <button type="button" id="updateBanner" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    $('#primaryColor').on('input', function() {
        $('.bg-primary').css('background-color', $(this).val());
    });

    $('#secondaryColor').on('input', function() {
        $('.bg-secondary').css('background-color', $(this).val());
    });

    $('#fontFamily').on('change', function() {
        $('#bg-secondary').css('font-family', $(this).val());
    });
</script>

<script>
    function loadAnnouncements() {
        $.ajax({
            url: '<?= base_url('profile/dashboard/announcement') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {

                $('#announcementTable tbody').empty();

                $.each(response.data, function(index, announcement) {
                    $('#announcementTable tbody').append(`
                        <tr>
                            <td>${announcement.announcement_id}</td>
                            <td>${announcement.message}</td>
                            <td>${announcement.ACTIVE == 1? 'Yes' : 'No'}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editAnnouncement" data-id="${announcement.announcement_id}">Edit</button>
                            <td>
                            <td>
                                <button class="btn btn-sm btn-danger deleteAnnouncement" data-id="${announcement.announcement_id}">Delete</button>
                            <td>
                        </tr>
                    `);
                });

            },
            error: function() {
                alert('Error loading announcements');
            }
        });
    }

    loadAnnouncements();
</script>

<script>
    $('#announcementTable').on('click', '.deleteAnnouncement', function() {
        const id = $(this).data('id');

        $.ajax({
            url: '<?= base_url('profile/dashboard/deleteAnnouncement/') ?>' + id,
            type: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    loadAnnouncements();
                } else {
                    alert('Failed to delete announcement');
                }
            }
        });
    });

    $('#announcementTable').on('click', '.editAnnouncement', function() {
        const id = $(this).data('id');

        $.ajax({
            url: '<?= base_url('profile/dashboard/editAnnouncement/') ?>' + id,
            type: 'GET',
            success: function(response) {

                $('#message').val(response.data.message);
                $('#active').prop('checked', response.data.ACTIVE == 1 ? true : false);
                $('#announcementId').val(id);

                $('#saveButton').hide();
                $('#updateButton').show();
                $('#announcementModal').modal('show');

            }
        });
    });


    $('#updateButton').on('click', function() {
        const id = $('#announcementId').val();

        const data = {
            message: $('#message').val(),
            ACTIVE: $('#active').prop('checked')
        };

        $.ajax({
            url: '<?= base_url('profile/dashboard/editAnnouncement/') ?>' + id,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.status === 'success') {
                    $('#announcementModal').modal('hide');
                    loadAnnouncements();
                } else {
                    alert('Failed to update announcement');
                }
            }
        });

    });
</script>

<script>
    $('#createAnnouncementBtn').on('click', function() {
        $('#saveButton').show();
        $('#updateButton').hide();

        $('#announcementModal').modal('show');
    });

    $('#announcementForm').on('submit', function(e) {
        e.preventDefault();

        const data = {
            message: $('#message').val(),
            ACTIVE: $('#active').prop('checked') ? 1 : 0
        };

        $.ajax({
            url: '<?= base_url('announcements/create') ?>',
            type: 'POST',
            data: data,
            success: function(response) {
                // Close modal
                $('#announcementModal').modal('hide');

                loadAnnouncements();
            },
            error: function(err) {
                alert('Error creating announcement');
            }
        });
    });

    $('#announcementModal').on('hidden.bs.modal', function() {
        $('#announcementForm')[0].reset();
        $('#announcementId').val('');
        $('#saveButton').show();
        $('#updateButton').hide();
    });
</script>

<script>
    $('#createBanner').on('click', function() {
        $('#bannerForm')[0].reset();
        $('#bannerId').val('');
        $('#saveBanner').show();
        $('#updateBanner').hide();
        $('#bannerModal').modal('show');
    });

    $('#saveBanner').on('click', function(e) {
        e.preventDefault();

        const data = {
            title: $('#title').val(),
            image_url: $('#imageUrl').val(),
            link_url: $('#linkUrl').val(),
            ACTIVE: $('#activeBanner').prop('checked') ? 1 : 0
        };

        $.ajax({
            url: '<?= base_url('banners/create') ?>',
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.status === 'success') {
                    $('#bannerModal').modal('hide');
                    loadBanners();
                }
            },
            error: function(xhr, status, error) {
                alert(`An unexpected error occurred: ${xhr.responseText || status}`);
            }
        });

    });
</script>
<script>
    function loadBanners() {
        $.ajax({
            url: '<?= base_url('banners'); ?>',
            type: 'GET',
            success: function(response) {
                const rows = response.data.map(banner => `
                    <tr>
                        <td>${banner.title}</td>
                        <td><img src="${banner.image_url}" width="100"/></td>
                        <td>${banner.ACTIVE == 1? 'Yes':'No'}</td>
                        <td><a href="${banner.link_url}">URL</a></td>
                        <td>
                            <button class="btn btn-sm btn-warning editBanner" data-id="${banner.banner_id}">Edit</button>
                            <button class="btn btn-sm btn-danger deleteBanner" data-id="${banner.banner_id}">Delete</button>
                        </td>
                    </tr>
                `);
                $('#bannersTable tbody').html(rows);
            }
        });
    }

    loadBanners();

    $('#bannersTable').on('click', '.editBanner', function() {
        const id = $(this).data('id');
        $.ajax({
            url: '<?= base_url('banners/edit/') ?>' + id,
            type: 'GET',
            success: function(response) {
                $('#bannerId').val(response.data.banner_id);
                $('#title').val(response.data.title);
                $('#imageUrl').val(response.data.image_url);
                $('#linkUrl').val(response.data.link_url);

                $('#activeBanner').prop('checked', response.data.ACTIVE == 1 ? true : false);

                $('#bannerModal').modal('show');
                $('#saveBanner').hide();
                $('#updateBanner').show();
            }
        });
    });


    $('#updateBanner').on('click', function(e) {
        e.preventDefault();

        const id = $('#bannerId').val();
        const data = {
            title: $('#title').val(),
            image_url: $('#imageUrl').val(),
            link_url: $('#linkUrl').val(),
            ACTIVE: $('#activeBanner').prop('checked') ? 1 : 0
        };

        $.ajax({
            url: '<?= base_url('banners/edit/') ?>' + id,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.status === 'success') {
                    $('#bannerModal').modal('hide');
                    loadBanners();
                }
            }
        });

    });
</script>

<?= $this->endSection() ?>