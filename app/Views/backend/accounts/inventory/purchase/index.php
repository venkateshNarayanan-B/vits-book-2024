<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<!-- DataTables CSS -->
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
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><?= esc($page_title) ?></h3>
                <div class="float-right">
                    <a href="<?= base_url('inventory/purchase-vouchers/create'); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Purchase Voucher
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="purchaseVouchersTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Voucher No</th>
                            <th>Date</th>
                            <th>Vendor</th>
                            <th>Total Amount</th>
                            <th>Tax</th>
                            <th>Discount</th>
                            <th>Net Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Purchase Voucher Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <!-- Details will load via AJAX -->
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<!-- DataTables JS -->
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/datatables-buttons/js/dataTables.buttons.min.js") ?>"></script>

<script>
$(document).ready(function () {
    // Initialize DataTable
    $('#purchaseVouchersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?= base_url('inventory/purchase-vouchers'); ?>",
        columns: [
            { data: "voucher_no" },
            { data: "date" },
            { data: "vendor_name" },
            { data: "total_amount" },
            { data: "tax_amount" },
            { data: "discount_amount" },
            { data: "net_amount" },
            { data: "actions", orderable: false, searchable: false }
        ]
    });

    // View Modal Logic
    $(document).on('click', '.btn-view', function () {
        let url = $(this).data('url');
        $('#viewModalBody').html('<p class="text-center">Loading...</p>');
        $('#viewModal').modal('show');

        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                if (response.status === 'success') {
                    let data = response.data;
                    let html = `
                        <h6><strong>Voucher No:</strong> ${data.voucher_no}</h6>
                        <h6><strong>Date:</strong> ${data.date}</h6>
                        <h6><strong>Vendor:</strong> ${data.vendor_name}</h6>
                        <h6><strong>Net Amount:</strong> ${data.net_amount}</h6>
                        <hr>
                        <h5>Items:</h5>
                        <ul>
                            ${data.items.map(item => `<li>${item.item_name} - Qty: ${item.quantity}, Rate: ${item.rate}</li>`).join('')}
                        </ul>
                    `;
                    $('#viewModalBody').html(html);
                } else {
                    $('#viewModalBody').html('<p class="text-danger">Failed to load voucher details.</p>');
                }
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
