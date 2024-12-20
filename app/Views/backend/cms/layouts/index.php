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
                    <h3 class="card-title">Manage Layouts for <?= esc($theme['theme_name']) ?></h3>
                    <a href="<?= base_url('cms/layouts/create/' . $theme['id']) ?>" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus"></i> Add New Layout
                    </a>
                </div>
                <div class="card-body">
                    <table id="layoutsTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Layout Name</th>
                                <th>Layout File</th>
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
        $('#layoutsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('cms/layouts/fetch/' . $theme['id']) ?>",
                "type": "POST",
            },
            "columns": [
                { "data": "id" },
                { "data": "layout_name" },
                { "data": "layout_file" },
                { 
                    "data": "id",
                    "orderable": false,
                    "render": function(data) {
                        return `
                            <a href="<?= base_url('cms/widgets/') ?>${data}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-th"></i> Assign Widgets
                            </a>
                            <a href="<?= base_url('cms/layouts/edit/') ?>${data}/<?= $theme['id'] ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${data}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        `;
                    }
                }
            ]
        });

        // Handle delete button click
        $('#layoutsTable').on('click', '.delete-btn', function () {
            const id = $(this).data('id');
            if (confirm('Are you sure you want to delete this layout?')) {
                $.ajax({
                    url: `<?= base_url('cms/layouts/delete/') ?>${id}/<?= $theme['id'] ?>`,
                    type: 'GET',
                    success: function () {
                        $('#layoutsTable').DataTable().ajax.reload();
                        Swal.fire('Deleted!', 'Layout deleted successfully.', 'success');
                    },
                    error: function () {
                        Swal.fire('Error!', 'Error deleting layout.', 'error');
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>
