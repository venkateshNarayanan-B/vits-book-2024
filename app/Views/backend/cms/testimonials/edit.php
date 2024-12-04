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
                    <h1>Edit Testimonial</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url("cms/testimonials") ?>">Testimonials</a></li>
                        <li class="breadcrumb-item active">Edit Testimonial</li>
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
                    <h3 class="card-title">Edit Testimonial</h3>
                </div>
                <form action="<?= base_url("cms/testimonials/update/" . $testimonial['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="client_name">Client Name</label>
                            <input type="text" name="client_name" id="client_name" class="form-control <?= isset($errors['client_name']) ? 'is-invalid' : '' ?>" value="<?= old('client_name', $testimonial['client_name']) ?>" placeholder="Enter client name">
                            <?php if (isset($errors['client_name'])): ?>
                                <div class="invalid-feedback"><?= $errors['client_name'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="testimonial_text">Testimonial</label>
                            <textarea name="testimonial_text" id="testimonial_text" class="form-control <?= isset($errors['testimonial_text']) ? 'is-invalid' : '' ?>" rows="5" placeholder="Enter testimonial"><?= old('testimonial_text', $testimonial['testimonial_text']) ?></textarea>
                            <?php if (isset($errors['testimonial_text'])): ?>
                                <div class="invalid-feedback"><?= $errors['testimonial_text'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="client_image">Client Image</label>
                            <input type="file" name="client_image" id="client_image" class="form-control <?= isset($errors['client_image']) ? 'is-invalid' : '' ?>">
                            <?php if (isset($errors['client_image'])): ?>
                                <div class="invalid-feedback"><?= $errors['client_image'] ?></div>
                            <?php endif; ?>
                            <?php if (!empty($testimonial['client_image'])): ?>
                                <div class="mt-3">
                                    <img src="<?= base_url('uploads/testimonials/' . $testimonial['client_image']) ?>" alt="Client Image" style="max-width: 100px;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="<?= base_url("cms/testimonials") ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<!-- Select2 -->
<script src="<?= base_url("assets/plugins/select2/js/select2.full.min.js") ?>"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });
</script>
<?= $this->endSection() ?>
