<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              Modals & Alerts
              <small>new</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modals & Alerts</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            

            

            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  SweetAlert2 Examples
                </h3>
              </div>
              <div class="card-body">
                <button type="button" class="btn btn-success swalDefaultSuccess">
                  Launch Success Toast
                </button>
                <button type="button" class="btn btn-info swalDefaultInfo">
                  Launch Info Toast
                </button>
                <button type="button" class="btn btn-danger swalDefaultError">
                  Launch Error Toast
                </button>
                <button type="button" class="btn btn-warning swalDefaultWarning">
                  Launch Warning Toast
                </button>
                <button type="button" class="btn btn-default swalDefaultQuestion">
                  Launch Question Toast
                </button>
                <div class="text-muted mt-3">
                  For more examples look at <a href="https://sweetalert2.github.io/">https://sweetalert2.github.io/</a>
                </div>
              </div>
              <!-- /.card -->
            </div>

            
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div><!-- /.container-fluid -->

      

      

      

      

      

      

      

      

      

      

      

    </section>
    <!-- /.content -->
  </div>
<?= $this->endSection() ?>