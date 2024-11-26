<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url("assets/plugins/select2/css/select2.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") ?>">

<!-- Summernote -->
<link rel="stylesheet" href="<?= base_url("assets/plugins/summernote/summernote-bs4.min.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= esc($page_title) ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/pages') ?>">Pages</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Page</h3>
                </div>
                <form action="<?= base_url('cms/pages/store') ?>" method="POST">
                    <div class="card-body">
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control <?= session('errors.title') ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= old('title') ?>" placeholder="Enter page title">
                            <div class="invalid-feedback">
                                <?= session('errors.title') ?>
                            </div>
                        </div>

                        <!-- Parent Page -->
                        <div class="form-group">
                            <label for="parent_id">Parent Page</label>
                            <select class="form-control select2bs4 <?= session('errors.parent_id') ? 'is-invalid' : '' ?>" id="parent_id" name="parent_id" style="width: 100%;">
                                <option value="">No Parent</option>
                                <?php foreach ($parentPages as $parent): ?>
                                <option value="<?= $parent['id'] ?>" <?= old('parent_id') == $parent['id'] ? 'selected' : '' ?>>
                                    <?= esc($parent['title']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors.parent_id') ?>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control summernote <?= session('errors.content') ? 'is-invalid' : '' ?>" id="content" name="content" rows="5"><?= old('content') ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors.content') ?>
                            </div>
                        </div>

                        <!-- Meta Keywords -->
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control <?= session('errors.meta_keywords') ? 'is-invalid' : '' ?>" id="meta_keywords" name="meta_keywords" value="<?= old('meta_keywords') ?>" placeholder="Enter meta keywords">
                            <div class="invalid-feedback">
                                <?= session('errors.meta_keywords') ?>
                            </div>
                        </div>

                        <!-- Meta Description -->
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control <?= session('errors.meta_description') ? 'is-invalid' : '' ?>" id="meta_description" name="meta_description" rows="2"><?= old('meta_description') ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors.meta_description') ?>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control select2bs4" id="status" name="status" style="width: 100%;">
                                <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Page</button>
                        <a href="<?= base_url('cms/pages') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<!-- Select2 -->
<script src="<?= base_url("assets/plugins/select2/js/select2.full.min.js") ?>"></script>

<!-- Summernote -->
<script src="<?= base_url("assets/plugins/summernote/summernote-bs4.min.js") ?>"></script>

<script>
    $(document).ready(function () {
        // Initialize Select2
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        });

        // Initialize Summernote
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
<?= $this->endSection() ?>
