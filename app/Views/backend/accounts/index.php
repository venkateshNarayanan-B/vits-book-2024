<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<link rel="stylesheet" href="<?= base_url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") ?>">
<?= $this->endSection(); ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Account Groups</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title">Account Groups List</h3>
                            <a href="<?= base_url('accounts/create-group') ?>" class="btn btn-primary btn-sm ml-auto">
                                <i class="fas fa-plus"></i> Create New Group
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="accountGroupsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Group Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section("scripts") ?>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
<script>
    $(function () {
        $('#accountGroupsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?= site_url('accounts/getData') ?>",
                type: "POST",
                data: { type: 'group' }
            },
            "columns": [
                { "data": "group_name" },
                { "data": "actions", "orderable": false, "searchable": false }
            ]
        });

        //Action functionanilty section
        // Edit Button Action
        $('#accountGroupsTable').on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        //alert('Edit button clicked for ID: ' + id);
        // Redirect to edit page or open edit modal
        window.location.href = "<?= site_url('accounts/edit-group/') ?>" + id;
        });

        // Delete Button Action
        $('#accountGroupsTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                url: '<?= site_url('accounts/delete-group/') ?>' + id,
                type: 'POST',
                success: function(response) {
                    $('#accountGroupsTable').DataTable().ajax.reload();
                    alert('Record deleted successfully');
                },
                error: function() {
                    alert('Error deleting record');
                }
                });
            }
        });
    });
</script>
<?= $this->endSection(); ?>