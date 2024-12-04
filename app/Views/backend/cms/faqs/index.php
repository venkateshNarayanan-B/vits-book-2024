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
                    <h3 class="card-title">Manage FAQs</h3>
                    <a href="<?= base_url('cms/faq/create') ?>" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus"></i> Add New FAQ
                    </a>
                </div>
                <div class="card-body">
                    <table id="faqsTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Status</th>
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
        $('#faqsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('cms/faq/datatable-data') ?>",
                "type": "POST",
            },
            "columns": [
                { "data": "id" },
                { "data": "question" },
                { "data": "answer" },
                { "data": "status" },
                { "data": "actions", "orderable": false }
            ]
        });

        // Handle delete button click
        $('#faqsTable').on('click', '.delete-btn', function () {
            const id = $(this).data('id');
            if (confirm('Are you sure you want to delete this FAQ?')) {
                $.ajax({
                    url: `<?= base_url('cms/faq/delete/') ?>${id}`,
                    type: 'POST',
                    data: { <?= csrf_token() ?>: '<?= csrf_hash() ?>' },
                    success: function (response) {
                        $('#faqsTable').DataTable().ajax.reload();
                        alert('FAQ deleted successfully');
                    },
                    error: function () {
                        alert('Error deleting FAQ');
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>
