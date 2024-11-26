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
                    <h1><?= $page_title ?? 'Services' ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Accounts</a></li>
                        <li class="breadcrumb-item active">Services</li>
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
                            <h3 class="card-title">Services List</h3>
                            <a href="<?= base_url('services/create') ?>" class="btn btn-primary btn-sm ml-auto">
                                <i class="fas fa-plus"></i> Add New Service
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="servicesTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Service Name</th>
                                        <th>Rate</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
<script src="<?= base_url("assets") ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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
        $('#servicesTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('services/get-data') ?>",
                "type": "GET"
            },
            "columns": [
                { "data": 0 }, // Service Name
                { "data": 1 }, // Rate
                { "data": 2 }  // Actions
            ],
            "columnDefs": [
                { "orderable": false, "targets": 2 } // Disable ordering for actions
            ]
        });
    });
</script>
<?= $this->endSection(); ?>
