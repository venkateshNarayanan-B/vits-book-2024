<?= $this->extend("layout/backend/main") ?>

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
            <h1>Role Permissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permissions</li>
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
                    <h3 class="card-title">Permissions List</h3>
                    <a href="<?= base_url('permissions/create') ?>" class="btn btn-primary btn-sm ml-auto">
                        <i class="fas fa-plus"></i> Add New Permission
                    </a>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Permissions</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Permissions</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
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
<!-- DataTables  & Plugins -->
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
  $(function () {
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "ajax": {
            url: "<?= site_url('permissions') ?>",
            type: "POST",
        },
      "columns": [
        { "data": "name" },
        { "data": "actions", "orderable": false, "searchable": false } // Actions column
      ]
    });

    //Action functionanilty section
    // Edit Button Action
    $('#example2').on('click', '.edit-btn', function() {
      var id = $(this).data('id');
      //alert('Edit button clicked for ID: ' + id);
      // Redirect to edit page or open edit modal
      window.location.href = "<?= site_url('permissions/edit/') ?>" + id;
    });

    // Delete Button Action
    $('#example2').on('click', '.delete-btn', function() {
      var id = $(this).data('id');
      if (confirm('Are you sure you want to delete this record?')) {
        $.ajax({
          url: '<?= site_url('permissions/delete/') ?>' + id,
          type: 'POST',
          success: function(response) {
            $('#example2').DataTable().ajax.reload();
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