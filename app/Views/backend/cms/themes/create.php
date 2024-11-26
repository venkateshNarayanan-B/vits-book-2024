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
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/themes') ?>">Themes</a></li>
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
                    <form action="<?= base_url('cms/themes/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="theme_name">Theme Name</label>
                            <input type="text" name="theme_name" id="theme_name" class="form-control <?= isset($errors['theme_name']) ? 'is-invalid' : '' ?>" value="<?= old('theme_name') ?>">
                            <?php if (isset($errors['theme_name'])): ?>
                                <div class="invalid-feedback"><?= $errors['theme_name'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="directory">Directory</label>
                            <input type="text" name="directory" id="directory" class="form-control <?= isset($errors['directory']) ? 'is-invalid' : '' ?>" value="<?= old('directory') ?>">
                            <?php if (isset($errors['directory'])): ?>
                                <div class="invalid-feedback"><?= $errors['directory'] ?></div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-success">Save Theme</button>
                        <a href="<?= base_url('cms/themes') ?>" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
