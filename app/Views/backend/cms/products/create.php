<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url("assets/plugins/select2/css/select2.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") ?>">
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
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/products') ?>">Products</a></li>
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
                    <h3 class="card-title">Add New Product</h3>
                </div>
                <form action="<?= base_url('cms/products/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= old('name') ?>" required>
                            <div class="invalid-feedback"><?= session('errors.name') ?></div>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control select2bs4 <?= session('errors.category_id') ? 'is-invalid' : '' ?>" id="category_id" name="category_id" style="width: 100%;" required>
                                <option value="">Select a Category</option>
                                <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                                    <?= esc($category['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.category_id') ?></div>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control <?= session('errors.price') ? 'is-invalid' : '' ?>" id="price" name="price" value="<?= old('price') ?>" placeholder="Enter product price">
                            <div class="invalid-feedback"><?= session('errors.price') ?></div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control <?= session('errors.description') ? 'is-invalid' : '' ?>" id="description" name="description" rows="5"><?= old('description') ?></textarea>
                            <div class="invalid-feedback"><?= session('errors.description') ?></div>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control <?= session('errors.status') ? 'is-invalid' : '' ?>" id="status" name="status" required>
                                <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.status') ?></div>
                        </div>

                        <!-- Specifications -->
                        <div class="form-group">
                            <label for="specifications">Specifications</label>
                            <div id="specifications-container">
                                <div class="specification-row d-flex mb-2">
                                    <input type="text" class="form-control mr-2" name="specifications[keys][]" placeholder="Specification Key">
                                    <input type="text" class="form-control" name="specifications[values][]" placeholder="Specification Value">
                                </div>
                            </div>
                            <button type="button" id="add-specification" class="btn btn-sm btn-secondary mt-2">+ Add Specification</button>
                        </div>

                        <!-- Product Images -->
                        <div class="form-group">
                            <label for="images">Product Images</label>
                            <input type="file" class="form-control <?= session('errors.images') ? 'is-invalid' : '' ?>" id="images" name="images[]" multiple>
                            <small class="form-text text-muted">You can upload multiple images. Mark one as featured after uploading.</small>
                            <div class="invalid-feedback"><?= session('errors.images') ?></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                        <a href="<?= base_url('cms/products') ?>" class="btn btn-secondary">Cancel</a>
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

<script>
    $(document).ready(function () {
        // Initialize Select2
        $('.select2bs4').select2({ theme: 'bootstrap4' });

        // Add Specification Row
        $('#add-specification').on('click', function () {
            const row = `
                <div class="specification-row d-flex mb-2">
                    <input type="text" class="form-control mr-2" name="specifications[keys][]" placeholder="Specification Key">
                    <input type="text" class="form-control" name="specifications[values][]" placeholder="Specification Value">
                    <button type="button" class="btn btn-danger btn-sm ml-2 remove-specification">Remove</button>
                </div>`;
            $('#specifications-container').append(row);
        });

        // Remove Specification Row
        $(document).on('click', '.remove-specification', function () {
            $(this).closest('.specification-row').remove();
        });
    });
</script>
<?= $this->endSection() ?>
