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
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/menus') ?>">Menus</a></li>
                        <li class="breadcrumb-item active"><?= esc($page_title) ?></li>
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
                    <h3 class="card-title"><?= esc($page_title) ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('cms/menus/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="menu_name">Menu Name</label>
                            <input type="text" name="menu_name" id="menu_name" class="form-control <?= isset($errors['menu_name']) ? 'is-invalid' : '' ?>" value="<?= old('menu_name') ?>">
                            <?php if (isset($errors['menu_name'])): ?>
                                <div class="invalid-feedback"><?= $errors['menu_name'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Parent Menu</label>
                            <select name="parent_id" id="parent_id" class="form-control select2">
                                <option value="">None</option>
                                <?php foreach ($parentMenus as $parentMenu): ?>
                                    <option value="<?= $parentMenu['id'] ?>" <?= old('parent_id') == $parentMenu['id'] ? 'selected' : '' ?>>
                                        <?= esc($parentMenu['menu_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" id="url" class="form-control <?= isset($errors['url']) ? 'is-invalid' : '' ?>" value="<?= old('url') ?>">
                            <?php if (isset($errors['url'])): ?>
                                <div class="invalid-feedback"><?= $errors['url'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" name="position" id="position" class="form-control <?= isset($errors['position']) ? 'is-invalid' : '' ?>" value="<?= old('position') ?>">
                            <?php if (isset($errors['position'])): ?>
                                <div class="invalid-feedback"><?= $errors['position'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control <?= isset($errors['status']) ? 'is-invalid' : '' ?>">
                                <option value="Active" <?= old('status') == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= old('status') == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                            <?php if (isset($errors['status'])): ?>
                                <div class="invalid-feedback"><?= $errors['status'] ?></div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-success">Save Menu</button>
                        <a href="<?= base_url('cms/menus') ?>" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
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
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });
</script>
<?= $this->endSection() ?>
