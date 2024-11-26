<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<!-- Summernote -->
<link rel="stylesheet" href="<?= base_url("assets/plugins/summernote/summernote-bs4.min.css") ?>">
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
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/content-blocks') ?>">Content Blocks</a></li>
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
                    <form action="<?= base_url('cms/content-blocks/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" value="<?= old('title') ?>">
                            <?php if (isset($errors['title'])): ?>
                                <div class="invalid-feedback"><?= $errors['title'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="identifier">Identifier</label>
                            <input type="text" name="identifier" id="identifier" class="form-control <?= isset($errors['identifier']) ? 'is-invalid' : '' ?>" value="<?= old('identifier') ?>">
                            <?php if (isset($errors['identifier'])): ?>
                                <div class="invalid-feedback"><?= $errors['identifier'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control summernote <?= isset($errors['content']) ? 'is-invalid' : '' ?>"><?= old('content') ?></textarea>
                            <?php if (isset($errors['content'])): ?>
                                <div class="invalid-feedback"><?= $errors['content'] ?></div>
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
                        <button type="submit" class="btn btn-success">Save Block</button>
                        <a href="<?= base_url('cms/content-blocks') ?>" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<!-- Summernote -->
<script src="<?= base_url("assets/plugins/summernote/summernote-bs4.min.js") ?>"></script>
<script>
    $(document).ready(function () {
        // Initialize Summernote
        $('.summernote').summernote({
            height: 200
        });
    });
</script>
<?= $this->endSection() ?>
