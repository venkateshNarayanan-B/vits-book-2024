<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Vouchers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Accounts</a></li>
                        <li class="breadcrumb-item active">Vouchers</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5>Vouchers</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-3 mb-3">
                                    <a class="btn btn-app bg-success w-100 text-center">
                                        <i class="fas fa-credit-card"></i> Payment
                                    </a>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <a class="btn btn-app bg-danger w-100 text-center">
                                        <i class="fas fa-receipt"></i> Receipt
                                    </a>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <a class="btn btn-app bg-info w-100 text-center">
                                        <i class="fas fa-pause"></i> Journal
                                    </a>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <a class="btn btn-app bg-warning w-100 text-center">
                                        <i class="fas fa-landmark"></i> Contra
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>
