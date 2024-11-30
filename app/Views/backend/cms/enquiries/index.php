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
                    <h3 class="card-title">Manage Enquiries</h3>
                </div>
                <div class="card-body">
                    <table id="enquiriesTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Product</th>
                                <th>Responded</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Viewing Enquiry -->
    <div class="modal fade" id="viewEnquiryModal" tabindex="-1" aria-labelledby="viewEnquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewEnquiryModalLabel">Enquiry Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="enquiryDetails">
                        <!-- Enquiry details will be loaded dynamically -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
        const table = $('#enquiriesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('cms/enquiries/get-data') ?>",
                "type": "POST",
            },
            "columns": [
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "product_name" },
                { 
                    "data": "responded",
                    "render": function(data) {
                        return data === 'Yes' 
                            ? '<span class="badge badge-success">Yes</span>' 
                            : '<span class="badge badge-danger">No</span>';
                    }
                },
                { "data": "created_at" },
                { 
                    "data": "id",
                    "render": function(data, type, row) {
                        const respondedButton = row.responded === 'Yes' 
                            ? `<button class="btn btn-secondary btn-sm" disabled>Responded</button>`
                            : `<form action="<?= base_url('cms/enquiries/respond/') ?>${data}" method="post" style="display:inline;">
                                   <?= csrf_field() ?>
                                   <button type="submit" class="btn btn-success btn-sm">Mark as Responded</button>
                               </form>`;
                        return `
                            <button class="btn btn-info btn-sm view-enquiry" data-id="${data}">View</button>
                            <form action="<?= base_url('cms/enquiries/delete/') ?>${data}" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            ${respondedButton}`;
                    }
                }
            ]
        });

        // Handle View button click
        $('body').on('click', '.view-enquiry', function () {
            const enquiryId = $(this).data('id');
            fetchEnquiryDetails(enquiryId);
        });
    });

    // Fetch enquiry details and load into the modal
    function fetchEnquiryDetails(id) {
        $.ajax({
            url: "<?= base_url('cms/enquiries/view/') ?>" + id,
            method: "GET",
            success: function (response) {
                $('#enquiryDetails').html(response);
                $('#viewEnquiryModal').modal('show');
            },
            error: function () {
                alert('Failed to fetch enquiry details.');
            }
        });
    }
</script>
<?= $this->endSection() ?>
