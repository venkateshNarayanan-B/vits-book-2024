<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>
    
    <section class="content">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title"><?= esc($title) ?></h3>
                <a href="<?= site_url('inventory/units/create') ?>" class="btn btn-primary btn-sm ml-auto">
                    <i class="fas fa-plus"></i> Add New Unit
                </a>
            </div>
            <div class="card-body">
               

                <!-- Units Table -->
                <table id="unitsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit Name</th>
                            <th>Conversion Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
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
    $(function () {
        $('#unitsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('inventory/units/') ?>",
                "type": "GET"
            },
            "columns": [
                {"data": 0}, // ID
                {"data": 1}, // Unit Name
                {"data": 2}, // Conversion Rate
                {"data": 3, "orderable": false} // Actions
            ]
        });
    });
</script>
<?= $this->endSection() ?>
