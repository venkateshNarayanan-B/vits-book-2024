<?= $this->extend("layout/backend/main") ?>

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
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/categories') ?>">Categories</a></li>
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
                    <h3 class="card-title">Edit Category</h3>
                </div>
                <form action="<?= base_url('cms/products/categories/update/' . $category['id']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= old('name', $category['name']) ?>" placeholder="Enter category name" required>
                            <div class="invalid-feedback"><?= session('errors.name') ?></div>
                        </div>

                        <!-- Category Image -->
                        <div class="form-group">
                            <label for="image">Category Image</label>
                            <input type="file" class="form-control-file <?= session('errors.image') ? 'is-invalid' : '' ?>" id="image" name="image" accept="image/*">
                            <div class="invalid-feedback"><?= session('errors.image') ?></div>
                            <?php if (!empty($category['image'])): ?>
                                <div class="mt-2">
                                    <p>Current Image:</p>
                                    <img src="<?= base_url('uploads/categories/' . $category['image']) ?>" alt="Category Image" width="100">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <a href="<?= base_url('cms/products/categories') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
