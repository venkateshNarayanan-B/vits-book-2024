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
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
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
  $(document).ready(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "<?= site_url('datatable-data') ?>",
            type: "POST",
        },
        "columns": [
            { "data": "engine" },
            { "data": "browser" },
            { "data": "platform" },
            { "data": "version" },
            { "data": "css_grade" },
            { "data": "actions", "orderable": false, "searchable": false } // Actions column
        ],
        "dom": 'Bfrtip',  // Ensure buttons are included at the top of the table
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
    
    //Action functionanilty section
    // Edit Button Action
    $('#example1').on('click', '.edit-btn', function() {
      var id = $(this).data('id');
      alert('Edit button clicked for ID: ' + id);
      // Redirect to edit page or open edit modal
      //window.location.href = "<?= site_url('edit/') ?>" + id;
    });

    // Delete Button Action
    $('#example1').on('click', '.delete-btn', function() {
      var id = $(this).data('id');
      if (confirm('Are you sure you want to delete this record?')) {
        $.ajax({
          url: '<?= site_url('delete/') ?>' + id,
          type: 'POST',
          success: function(response) {
            $('#example1').DataTable().ajax.reload();
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