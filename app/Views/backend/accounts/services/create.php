<?= $this->extend('layout/backend/main') ?>

<?= $this->section("styles") ?>
<!-- Add any specific styles if needed -->
<?= $this->endSection(); ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $page_title ?? 'Add New Service' ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('services') ?>">Services</a></li>
                        <li class="breadcrumb-item active">Add New Service</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- General form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Service</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= base_url('services/store') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                

                                <!-- Service Name -->
                                <div class="form-group">
                                    <label for="service_name">Service Name</label>
                                    <input type="text" name="service_name" id="service_name" class="form-control <?= session('errors.service_name') ? 'is-invalid' : '' ?>" value="<?= old('service_name') ?>" placeholder="Enter service name">
                                    <?php if (session('errors.service_name')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.service_name') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Service Rate -->
                                <div class="form-group">
                                    <label for="rate">Rate</label>
                                    <input type="number" name="rate" id="rate" class="form-control <?= session('errors.rate') ? 'is-invalid' : '' ?>" value="<?= old('rate') ?>" placeholder="Enter service rate">
                                    <?php if (session('errors.rate')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.rate') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?= base_url('services') ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection(); ?>

<?= $this->section("scripts") ?>
<script>
    $(document).ready(function() {
        // Additional JavaScript if needed
    });
</script>
<?= $this->endSection(); ?>
