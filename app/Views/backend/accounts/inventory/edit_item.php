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
        </div>
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
                            <form action="<?= base_url('inventory/item/update/' . $item['id']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <!-- Basic Fields -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="item_name">Item Name <span class="text-danger">*</span></label>
                                            <input type="text" name="item_name" id="item_name" class="form-control" value="<?= old('item_name', esc($item['item_name'])) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category <span class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control select2" required>
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= $category['id'] ?>" <?= old('category_id', $item['category_id']) == $category['id'] ? 'selected' : '' ?>>
                                                        <?= esc($category['category_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="primary_unit_id">Primary Unit</label>
                                            <select name="primary_unit_id" id="primary_unit_id" class="form-control select2" required>
                                                <option value="">-- Select Unit --</option>
                                                <?php foreach ($units as $unit): ?>
                                                    <option value="<?= esc($unit['id']) ?>" <?= isset($item) && $item['primary_unit_id'] == $unit['id'] ? 'selected' : '' ?>>
                                                        <?= esc($unit['unit_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hsn_code">HSN Code <span class="text-danger">*</span></label>
                                            <input type="text" name="hsn_code" id="hsn_code" class="form-control" value="<?= old('hsn_code', esc($item['hsn_code'])) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tax_rate">Tax Rate (%) <span class="text-danger">*</span></label>
                                            <input type="number" name="tax_rate" id="tax_rate" class="form-control" value="<?= old('tax_rate', esc($item['tax_rate'])) ?>" step="0.01" min="0" max="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rate">Rate <span class="text-danger">*</span></label>
                                            <input type="text" name="rate" id="rate" class="form-control" value="<?= old('rate', esc($item['rate'])) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="opening_stock">Opening Stock</label>
                                            <input type="number" name="opening_stock" id="opening_stock" class="form-control" value="<?= old('opening_stock', esc($item['opening_stock'])) ?>">
                                        </div>
                                    </div>

                                    <!-- Optional Fields -->
                                    <div class="col-md-12">
                                        <h4 class="mt-3">Optional Fields</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand">Brand</label>
                                            <input type="text" name="brand" id="brand" class="form-control" value="<?= old('brand', esc($item['brand'])) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <input type="text" name="color" id="color" class="form-control" value="<?= old('color', esc($item['color'])) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="size">Size</label>
                                            <input type="text" name="size" id="size" class="form-control" value="<?= old('size', esc($item['size'])) ?>">
                                        </div>
                                    </div>

                                    <!-- Serial Numbers Section -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="requires_serial">Requires Serial Numbers</label>
                                            <div class="form-check">
                                                <input type="checkbox" name="requires_serial" id="requires_serial" class="form-check-input" <?= !empty($serial_numbers) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="requires_serial">Yes, this item requires serial numbers</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="serial-numbers-section" class="col-md-12" style="<?= !empty($serial_numbers) ? 'display: block;' : 'display: none;' ?>">
                                        <label for="serial_numbers">Serial Numbers</label>
                                        <div id="serial-numbers-wrapper">
                                            <?php if (!empty($serial_numbers)): ?>
                                                <?php foreach ($serial_numbers as $serial): ?>
                                                    <div class="input-group mb-2">
                                                        <input type="text" name="serial_numbers[]" class="form-control" value="<?= esc($serial['serial_number']) ?>">
                                                        <button type="button" class="btn btn-danger remove-serial-number">Remove</button>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="input-group mb-2">
                                                    <input type="text" name="serial_numbers[]" class="form-control" placeholder="Enter Serial Number">
                                                    <button type="button" class="btn btn-danger remove-serial-number">Remove</button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <button type="button" id="add-serial-number" class="btn btn-primary mt-2">Add Serial Number</button>
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

<script>
    document.getElementById('requires_serial').addEventListener('change', function () {
        const section = document.getElementById('serial-numbers-section');
        section.style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('add-serial-number').addEventListener('click', function () {
        const wrapper = document.getElementById('serial-numbers-wrapper');
        wrapper.insertAdjacentHTML('beforeend', `
            <div class="input-group mb-2">
                <input type="text" name="serial_numbers[]" class="form-control" placeholder="Enter Serial Number">
                <button type="button" class="btn btn-danger remove-serial-number">Remove</button>
            </div>
        `);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-serial-number')) {
            e.target.closest('.input-group').remove();
        }
    });
</script>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Add any additional scripts here -->
<?= $this->endSection() ?>
