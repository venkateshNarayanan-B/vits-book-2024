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
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/faq') ?>">FAQs</a></li>
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
                    <h3 class="card-title">Edit FAQ</h3>
                </div>
                <form action="<?= base_url('cms/faq/update/' . $faq['id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <!-- Question -->
                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" class="form-control <?= session('errors.question') ? 'is-invalid' : '' ?>" id="question" name="question" value="<?= old('question', $faq['question']) ?>" placeholder="Enter FAQ question" required>
                            <div class="invalid-feedback"><?= session('errors.question') ?></div>
                        </div>

                        <!-- Answer -->
                        <div class="form-group">
                            <label for="answer">Answer</label>
                            <textarea class="form-control <?= session('errors.answer') ? 'is-invalid' : '' ?>" id="answer" name="answer" rows="5" placeholder="Enter FAQ answer" required><?= old('answer', $faq['answer']) ?></textarea>
                            <div class="invalid-feedback"><?= session('errors.answer') ?></div>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control <?= session('errors.status') ? 'is-invalid' : '' ?>" id="status" name="status" required>
                                <option value="1" <?= old('status', $faq['status']) == '1' ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= old('status', $faq['status']) == '0' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.status') ?></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update FAQ</button>
                        <a href="<?= base_url('cms/faq') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
