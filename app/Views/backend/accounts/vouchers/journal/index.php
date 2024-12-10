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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><?= esc($page_title) ?></h3>
                    </div>

                    <!-- Flash Message for Success -->
                    <?php if (session()->getFlashdata('swal_success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('swal_success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <a href="<?= site_url('journal-vouchers/create') ?>" class="btn btn-info mb-3">Create New Journal Voucher</a>

                        <table id="journalVouchersTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Reference No</th>
                                    <th>Debit Ledger</th>
                                    <th>Credit Ledger</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
    $('#journalVouchersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= site_url('journal-vouchers') ?>",
            type: "GET"
        },
        columns: [
            {data: 0, title: "ID"}, // Voucher ID
            {data: 1, title: "Date"}, // Voucher Date
            {data: 2, title: "Reference No"}, // Reference Number
            {data: 3, title: "Debit Ledger"}, // Debit Ledger Name
            {data: 4, title: "Credit Ledger"}, // Credit Ledger Name
            {data: 5, title: "Amount"}, // Amount
            {data: 6, title: "Actions", orderable: false, searchable: false} // Edit/Delete Actions
        ]
    });
</script>
<?= $this->endSection() ?>
