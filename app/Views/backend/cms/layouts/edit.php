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
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/layouts/' . $theme['id']) ?>">Layouts</a></li>
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
                    <form action="<?= base_url('cms/layouts/update/' . $layout['id'] . '/' . $theme['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="layout_name">Layout Name</label>
                            <input type="text" name="layout_name" id="layout_name" class="form-control <?= isset($errors['layout_name']) ? 'is-invalid' : '' ?>" value="<?= old('layout_name', $layout['layout_name']) ?>" required>
                            <?php if (isset($errors['layout_name'])): ?>
                                <div class="invalid-feedback"><?= $errors['layout_name'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="layout_file">Layout File</label>
                            <input type="text" name="layout_file" id="layout_file" class="form-control <?= isset($errors['layout_file']) ? 'is-invalid' : '' ?>" value="<?= old('layout_file', $layout['layout_file']) ?>" required>
                            <small class="form-text text-muted">Enter the filename for this layout, e.g., <code>header</code>, <code>footer</code>.</small>
                            <?php if (isset($errors['layout_file'])): ?>
                                <div class="invalid-feedback"><?= $errors['layout_file'] ?></div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-success">Update Layout</button>
                        <a href="<?= base_url('cms/layouts/' . $theme['id']) ?>" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
