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
                    <h1>Add New Item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('inventory/items') ?>">Items</a></li>
                        <li class="breadcrumb-item active">Add Item</li>
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
                            <h3 class="card-title">Enter Item Details</h3>
                        </div>
                        <div class="card-body">
                            <!-- Form to Add Item -->
                            <form action="<?= base_url('inventory/item/store') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="item_name">Item Name <span class="text-danger">*</span></label>
                                            <input type="text" name="item_name" id="item_name" class="form-control" value="<?= old('item_name') ?>" required>
                                            <?php if (isset($errors['item_name'])): ?>
                                                <div class="text-danger"><?= $errors['item_name'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category <span class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control select2" required>
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= $category['id'] ?>" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
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
                                            <label for="unit">Unit <span class="text-danger">*</span></label>
                                            <input type="text" name="unit" id="unit" class="form-control" value="<?= old('unit') ?>" required>
                                            <?php if (isset($errors['unit'])): ?>
                                                <div class="text-danger"><?= $errors['unit'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hsn_code">HSN Code <span class="text-danger">*</span></label>
                                            <input type="text" name="hsn_code" id="hsn_code" class="form-control" value="<?= old('hsn_code') ?>" required>
                                            <?php if (isset($errors['hsn_code'])): ?>
                                                <div class="text-danger"><?= $errors['hsn_code'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tax_rate">Tax Rate (%) <span class="text-danger">*</span></label>
                                            <input type="number" name="tax_rate" id="tax_rate" class="form-control" value="<?= old('tax_rate') ?>" step="0.01" min="0" max="100" required>
                                            <?php if (isset($errors['tax_rate'])): ?>
                                                <div class="text-danger"><?= $errors['tax_rate'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rate">Rate <span class="text-danger">*</span></label>
                                            <input type="text" name="rate" id="rate" class="form-control" value="<?= old('rate') ?>" required>
                                            <?php if (isset($errors['rate'])): ?>
                                                <div class="text-danger"><?= $errors['rate'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand">Brand</label>
                                            <input type="text" name="brand" id="brand" class="form-control" value="<?= old('brand') ?>" >
                                            <?php if (isset($errors['brand'])): ?>
                                                <div class="text-danger"><?= $errors['brand'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <input type="text" name="color" id="color" class="form-control" value="<?= old('color') ?>" >
                                            <?php if (isset($errors['color'])): ?>
                                                <div class="text-danger"><?= $errors['color'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="size">Size</label>
                                            <input type="text" name="size" id="size" class="form-control" value="<?= old('size') ?>" >
                                            <?php if (isset($errors['size'])): ?>
                                                <div class="text-danger"><?= $errors['size'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="opening_stock">Opening Stock</label>
                                            <input type="text" name="opening_stock" id="opening_stock" class="form-control" value="<?= old('opening_stock') ?>" required>
                                            <?php if (isset($errors['opening_stock'])): ?>
                                                <div class="text-danger"><?= $errors['opening_stock'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Save Item</button>
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
