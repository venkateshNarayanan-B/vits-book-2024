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
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/sliders') ?>">Sliders</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('cms/sliders/slides/' . $slider['id']) ?>">Slides</a></li>
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
                    <form action="<?= base_url('cms/sliders/slides/update/' . $slide['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" value="<?= old('title', $slide['title']) ?>">
                            <?php if (isset($errors['title'])): ?>
                                <div class="invalid-feedback"><?= $errors['title'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"><?= old('description', $slide['description']) ?></textarea>
                        </div>

                        <!-- Image -->
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>">
                            <small>Current Image: <img src="<?= base_url('uploads/slides/' . $slide['image']) ?>" alt="<?= esc($slide['title']) ?>" class="img-thumbnail" style="width: 80px;"></small>
                            <?php if (isset($errors['image'])): ?>
                                <div class="invalid-feedback"><?= $errors['image'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Button Text -->
                        <div class="form-group">
                            <label for="button_text">Button Text</label>
                            <input type="text" name="button_text" id="button_text" class="form-control" value="<?= old('button_text', $slide['button_text']) ?>">
                        </div>

                        <!-- Button Link -->
                        <div class="form-group">
                            <label for="button_link">Button Link</label>
                            <input type="url" name="button_link" id="button_link" class="form-control" value="<?= old('button_link', $slide['button_link']) ?>">
                        </div>

                        <!-- Position -->
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" name="position" id="position" class="form-control" value="<?= old('position', $slide['position']) ?>">
                        </div>

                        <button type="submit" class="btn btn-success">Update Slide</button>
                        <a href="<?= base_url('cms/sliders/slides/' . $slider['id']) ?>" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<script>
    $(document).ready(function () {
        $('.select2').select2({ theme: 'bootstrap4' });
    });
</script>
<?= $this->endSection() ?>
