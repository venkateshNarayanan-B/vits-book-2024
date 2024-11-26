<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="<?= base_url("assets/plugins/ekko-lightbox/ekko-lightbox.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= esc($page_title) ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= esc($page_title) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Media Files</h3>
                            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#uploadModal">
                                <i class="fas fa-upload"></i> Upload File
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row" id="mediaGallery"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Media File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadForm" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Select File</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<script src="<?= base_url("assets/plugins/ekko-lightbox/ekko-lightbox.min.js") ?>"></script>
<script>
    $(document).ready(function () {
        // Load media files
        function loadMediaFiles() {
            $.ajax({
                url: "<?= base_url('cms/media-manager/get-files') ?>",
                type: "POST",
                success: function(response) {
                    let mediaGallery = $('#mediaGallery');
                    mediaGallery.empty();

                    response.data.forEach(function(file) {
                        let mediaItem = `
                            <div class="col-sm-3">
                                <a href="<?= base_url() ?>/${file.file_path}" data-toggle="lightbox" data-title="${file.file_name}" data-gallery="gallery">
                                    <img src="<?= base_url() ?>/${file.file_path}" class="img-fluid mb-2" alt="${file.file_name}">
                                </a>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${file.id}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        `;
                        mediaGallery.append(mediaItem);
                    });

                    // Initialize lightbox
                    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                        event.preventDefault();
                        $(this).ekkoLightbox({ alwaysShowClose: true });
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Failed to load media files: ", error);
                    alert('Failed to load media files. Please refresh the page.');
                }
            });
        }

        loadMediaFiles();

        // Handle file upload
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "<?= base_url('cms/media-manager/upload') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#uploadModal').modal('hide');
                        loadMediaFiles();
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
            console.error("Upload failed: ", xhr.responseText);
            alert('Failed to upload the file. Error: ' + error);
        }
            });
        });

        // Handle delete action
        $('#mediaGallery').on('click', '.delete-btn', function () {
            const id = $(this).data('id');
            if (confirm('Are you sure you want to delete this file?')) {
                $.ajax({
                    url: `<?= base_url('cms/media-manager/delete/') ?>${id}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            loadMediaFiles();
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("File deletion failed: ", error);
                        alert('Failed to delete the file.');
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>
