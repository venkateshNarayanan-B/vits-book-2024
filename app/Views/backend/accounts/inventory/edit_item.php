<?= $this->extend('layout/backend/main') ?>

<?= $this->section('styles') ?>
<!-- Add any additional styles here if needed -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('inventory/items') ?>">Items</a></li>
                        <li class="breadcrumb-item active">Edit Item</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Item Details</h3>
                        </div>
                        <div class="card-body">
                            <!-- Form to Edit Item -->
                            <form action="<?= base_url('inventory/item/update/' . $item['id']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="item_name">Item Name</label>
                                            <input type="text" name="item_name" id="item_name" class="form-control" value="<?= old('item_name', esc($item['item_name'])) ?>" required>
                                            <?php if (isset($errors['item_name'])): ?>
                                                <div class="text-danger"><?= $errors['item_name'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" id="category_id" class="form-control select2" required>
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= $category['id'] ?>" <?= old('category_id', $item['category_id']) == $category['id'] ? 'selected' : '' ?>>
                                                        <?= esc($category['category_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($errors['category_id'])): ?>
                                                <div class="text-danger"><?= $errors['category_id'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unit">Unit</label>
                                            <input type="text" name="unit" id="unit" class="form-control" value="<?= old('unit', esc($item['unit'])) ?>" required>
                                            <?php if (isset($errors['unit'])): ?>
                                                <div class="text-danger"><?= $errors['unit'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rate">Rate</label>
                                            <input type="text" name="rate" id="rate" class="form-control" value="<?= old('rate', esc($item['rate'])) ?>" required>
                                            <?php if (isset($errors['rate'])): ?>
                                                <div class="text-danger"><?= $errors['rate'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="opening_stock">Opening Stock</label>
                                            <input type="text" name="opening_stock" id="opening_stock" class="form-control" value="<?= old('opening_stock', esc($item['opening_stock'])) ?>" required>
                                            <?php if (isset($errors['opening_stock'])): ?>
                                                <div class="text-danger"><?= $errors['opening_stock'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Update Item</button>
                                    <a href="<?= base_url('inventory/items') ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Add any additional scripts here -->
<?= $this->endSection() ?>
