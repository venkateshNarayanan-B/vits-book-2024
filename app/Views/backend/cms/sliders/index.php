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
                    <h3 class="card-title">Manage Sliders</h3>
                    <a href="<?= base_url('cms/sliders/create') ?>" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus"></i> Add New Slider
                    </a>
                </div>
                <div class="card-body">
                    <table id="slidersTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Slider Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
<script src="<?= base_url("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/datatables-buttons/js/dataTables.buttons.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") ?>"></script>

<script>
    $(document).ready(function () {
        $('#slidersTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('cms/sliders/getSlidersData') ?>",
                "type": "POST",
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { 
                    "data": "status",
                    "render": function(data) {
                        return data === 'Active' 
                            ? '<span class="badge badge-success">Active</span>' 
                            : '<span class="badge badge-danger">Inactive</span>';
                    }
                },
                { "data": "created_at" },
                { "data": "updated_at" },
                { 
                    "data": "id",
                    "orderable": false,
                    "render": function(data) {
                        return `
                            <a href="<?= base_url('cms/sliders/slides/') ?>${data}" class="btn btn-warning btn-sm">
                                <i class="fas fa-images"></i> Manage Slides
                            </a>
                            <a href="<?= base_url('cms/sliders/edit/') ?>${data}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${data}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        `;
                    }
                },
            ]
        });

        // Handle delete button click
        $('#slidersTable').on('click', '.delete-btn', function () {
            const id = $(this).data('id');
            if (confirm('Are you sure you want to delete this slider?')) {
                $.ajax({
                    url: `<?= base_url('cms/sliders/delete/') ?>${id}`,
                    type: 'GET',
                    success: function (response) {
                        $('#slidersTable').DataTable().ajax.reload();
                        alert('Slider deleted successfully');
                    },
                    error: function () {
                        alert('Error deleting slider');
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>
