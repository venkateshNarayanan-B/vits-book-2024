<?= $this->extend('layout/backend/main') ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $page_title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('categories') ?>">Categories</a></li>
                        <li class="breadcrumb-item active"><?= $page_title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <!-- form start -->
                        <form action="<?= base_url('categories/store') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                               

                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input 
                                        type="text" 
                                        name="category_name" 
                                        id="category_name" 
                                        class="form-control <?= (session('errors.category_name') ? 'is-invalid' : '') ?>" 
                                        placeholder="Enter category name" 
                                        value="<?= old('category_name') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.category_name') ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('categories') ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>
