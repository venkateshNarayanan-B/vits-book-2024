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

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manage Widget Placements</h3>
                    <a href="<?= base_url("cms/widgets/create/{$layoutId}") ?>" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus"></i> Add Widget Placement
                    </a>
                </div>
                <div class="card-body">
                    <table id="widgetTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Widget Name</th>
                                <th>Position</th>
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
<?php $widgetsConfig = new \Config\Widgets();  ?>
<script>
    $(document).ready(function () {
        $('#widgetTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url("cms/widgets/fetch/{$layoutId}") ?>",
                "type": "POST",
            },
            "columns": [
                { "data": "id" },
                { "data": "widget_name" },
                { 
                    "data": "position",
                    "render": function(data) {
                        const positions = <?= json_encode($widgetsConfig->positions) ?>;
                        return positions[data] ? positions[data].charAt(0).toUpperCase() + positions[data].slice(1) : 'Unknown';
                    }
                },
                { "data": "actions", "orderable": false }
            ]
        });
    });
</script>
<?= $this->endSection() ?>
