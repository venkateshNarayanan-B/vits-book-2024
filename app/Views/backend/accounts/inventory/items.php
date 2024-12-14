<?= $this->extend('layout/backend/main') ?>

<?= $this->section("styles") ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url("assets") ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url("assets") ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url("assets") ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= esc($page_title) ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Inventory</a></li>
                        <li class="breadcrumb-item active"><?= esc($title) ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title"><?= esc($title) ?></h3>
                            <a href="<?= base_url('inventory/item/create') ?>" class="btn btn-primary btn-sm ml-auto">
                                <i class="fas fa-plus"></i> Add New Item
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="itemsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Opening Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DataTables will populate this dynamically -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>

<?= $this->section("scripts") ?>
<!-- DataTables & Plugins -->
<script src="<?= base_url("assets") ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url("assets") ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url("assets") ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        $('#itemsTable').DataTable({
            paging: true,
            lengthChange: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('inventory/items/fetch') ?>",
                type: "GET"
            },
            columns: [
                { "data": 0 }, // Item Name
                { "data": 1 }, // Category
                { "data": 2 }, // Unit
                { "data": 3 }, // Rate
                { "data": 4 }, // Opening Stock
                { "data": 5 }, // Actions
            ],
            columnDefs: [
                { "orderable": false, "targets": 5 } // Disable sorting on Actions column
            ]
        });
    });
</script>
<?= $this->endSection(); ?>
