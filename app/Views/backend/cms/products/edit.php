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
                        <li class="breadcrumb-item active">Edit</li>
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
                    <h3 class="card-title">Edit Product</h3>
                </div>
                <form action="<?= base_url('cms/products/update/' . $product['id']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= old('name', $product['name']) ?>" required>
                            <div class="invalid-feedback"><?= session('errors.name') ?></div>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control select2bs4 <?= session('errors.category_id') ? 'is-invalid' : '' ?>" id="category_id" name="category_id" style="width: 100%;" required>
                                <option value="">Select a Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" <?= old('category_id', $product['category_id']) == $category['id'] ? 'selected' : '' ?>>
                                        <?= esc($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.category_id') ?></div>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control <?= session('errors.price') ? 'is-invalid' : '' ?>" id="price" name="price" value="<?= old('price', $product['price']) ?>" placeholder="Enter product price">
                            <div class="invalid-feedback"><?= session('errors.price') ?></div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5"><?= old('description', $product['description']) ?></textarea>
                        </div>

                        <!-- Meta Title -->
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control <?= session('errors.meta_title') ? 'is-invalid' : '' ?>" id="meta_title" name="meta_title" value="<?= old('meta_title', $product['meta_title']) ?>" required>
                            <div class="invalid-feedback"><?= session('errors.meta_title') ?></div>
                        </div>

                        <!-- Meta Description -->
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control <?= session('errors.meta_description') ? 'is-invalid' : '' ?>" id="meta_description" name="meta_description" rows="5"><?= old('meta_description', $product['meta_description']) ?></textarea>
                            <div class="invalid-feedback"><?= session('errors.meta_description') ?></div>
                        </div>

                        <!-- Meta Keywords -->
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <textarea class="form-control <?= session('errors.meta_keywords') ? 'is-invalid' : '' ?>" id="meta_keywords" name="meta_keywords" rows="5"><?= old('meta_keywords', $product['meta_keywords']) ?></textarea>
                            <div class="invalid-feedback"><?= session('errors.meta_keywords') ?></div>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active" <?= old('status', $product['status']) == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status', $product['status']) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <!-- Specifications -->
                        <div class="form-group">
                            <label for="specifications">Specifications</label>
                            <div id="specifications-container">
                                <?php foreach ($specifications as $spec): ?>
                                    <div class="specification-row d-flex mb-2">
                                        <input type="text" class="form-control mr-2" name="specifications[keys][]" value="<?= esc($spec['specification_key']) ?>" placeholder="Specification Key">
                                        <input type="text" class="form-control" name="specifications[values][]" value="<?= esc($spec['specification_value']) ?>" placeholder="Specification Value">
                                        <button type="button" class="btn btn-danger btn-sm ml-2 remove-specification">Remove</button>
                                    </div>
                                <?php endforeach; ?>
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
                            <input type="file" name="images[]" class="form-control" multiple>
                            <div class="mt-3">
                                <?php foreach ($images as $image): ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="<?= base_url($image['image_path']) ?>" alt="Image" style="height: 50px; width: 50px; margin-right: 10px;">
                                        <button type="button" class="btn btn-sm btn-success set-featured-image" data-id="<?= $image['id'] ?>" <?= $image['is_featured'] ? 'disabled' : '' ?>>
                                            Set as Featured
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger ml-2 delete-image" data-id="<?= $image['id'] ?>">Delete</button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Product</button>
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

        // Set Featured Image
        $('.set-featured-image').on('click', function () {
            const imageId = $(this).data('id');
            $.ajax({
                url: `<?= base_url('cms/products/set-featured-image') ?>/${imageId}/<?= $product['id'] ?>`,
                method: 'POST',
                data: { <?= csrf_token() ?>: '<?= csrf_hash() ?>' },
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Failed to set the featured image.');
                    }
                },
                error: function () {
                    alert('An error occurred while setting the featured image.');
                }
            });
        });

        // Delete Image
        $('.delete-image').on('click', function () {
            const imageId = $(this).data('id');
            if (confirm('Are you sure you want to delete this image?')) {
                $.ajax({
                    url: `<?= base_url('cms/products/delete-image') ?>/${imageId}`,
                    method: 'POST',
                    data: { <?= csrf_token() ?>: '<?= csrf_hash() ?>' },
                    success: function (response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert('Failed to delete the image.');
                        }
                    },
                    error: function () {
                        alert('An error occurred while deleting the image.');
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>
