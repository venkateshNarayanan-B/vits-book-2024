<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") ?>">
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
                    <a href="<?= base_url('cms/sliders/slides/create/' . $slider['id']) ?>" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus"></i> Add New Slide
                    </a>
                </div>
                <div class="card-body">
                    <table id="slidesTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Button Text</th>
                                <th>Button Link</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($slides as $slide): ?>
                                <tr>
                                    <td><?= esc($slide['title']) ?></td>
                                    <td><img src="<?= base_url('uploads/slides/' . $slide['image']) ?>" alt="<?= esc($slide['title']) ?>" class="img-thumbnail" style="width: 80px;"></td>
                                    <td><?= esc($slide['description']) ?></td>
                                    <td><?= esc($slide['button_text']) ?></td>
                                    <td><a href="<?= esc($slide['button_link']) ?>" target="_blank"><?= esc($slide['button_link']) ?></a></td>
                                    <td><?= esc($slide['position']) ?></td>
                                    <td>
                                        <a href="<?= base_url('cms/sliders/slides/edit/' . $slide['id']) ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="<?= base_url('cms/sliders/slides/delete/' . $slide['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slide?');"><i class="fas fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<!-- DataTables -->
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js") ?>"></script>
<script>
    $(document).ready(function () {
        $('#slidesTable').DataTable();
    });
</script>
<?= $this->endSection() ?>
