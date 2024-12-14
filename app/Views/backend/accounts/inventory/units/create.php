<?= $this->extend('layout/backend/main') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Page Header -->
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= esc($title) ?></h3>
            </div>
            <div class="card-body">
                <!-- Validation Errors -->
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <!-- Unit Form -->
                <form action="<?= site_url('inventory/units/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Unit Name -->
                    <div class="form-group">
                        <label for="unit_name">Unit Name</label>
                        <input type="text" name="unit_name" id="unit_name" class="form-control" value="<?= old('unit_name') ?>" required>
                    </div>

                    <!-- Conversion Rate -->
                    <div class="form-group">
                        <label for="conversion_rate">Conversion Rate (Optional)</label>
                        <input type="number" step="0.0001" name="conversion_rate" id="conversion_rate" class="form-control" value="<?= old('conversion_rate', '1.0000') ?>">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="<?= site_url('inventory/units/') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
