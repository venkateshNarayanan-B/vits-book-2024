<?= $this->extend("layout/backend/main") ?>

<?= $this->section("styles") ?>
<!-- Add any page-specific styles here -->
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= esc($page_title ?? 'Register') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Register</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Register</h3>
                        </div>
                        <!-- Form Start -->
                        <?= form_open('register', ['class' => 'form-horizontal']) ?>
                        <div class="card-body">
                            <!-- Username Field -->
                            <div class="form-group row">
                                <?= form_label('Username', 'username', ['class' => 'col-sm-3 col-form-label']) ?>
                                <div class="col-sm-9">
                                    <?= form_input([
                                        'name' => 'username',
                                        'id' => 'username',
                                        'value' => old('username'),
                                        'class' => 'form-control' . (session('errors.username') ? ' is-invalid' : ''),
                                        'placeholder' => 'Username'
                                    ]) ?>
                                    <?= session('errors.username') ? '<div class="invalid-feedback">' . session('errors.username') . '</div>' : '' ?>
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="form-group row">
                                <?= form_label('Email', 'email', ['class' => 'col-sm-3 col-form-label']) ?>
                                <div class="col-sm-9">
                                    <?= form_input([
                                        'type' => 'email',
                                        'name' => 'email',
                                        'id' => 'email',
                                        'value' => old('email'),
                                        'class' => 'form-control' . (session('errors.email') ? ' is-invalid' : ''),
                                        'placeholder' => 'Email'
                                    ]) ?>
                                    <?= session('errors.email') ? '<div class="invalid-feedback">' . session('errors.email') . '</div>' : '' ?>
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="form-group row">
                                <?= form_label('Password', 'password', ['class' => 'col-sm-3 col-form-label']) ?>
                                <div class="col-sm-9">
                                    <?= form_password([
                                        'name' => 'password',
                                        'id' => 'password',
                                        'class' => 'form-control' . (session('errors.password') ? ' is-invalid' : ''),
                                        'placeholder' => 'Password'
                                    ]) ?>
                                    <?= session('errors.password') ? '<div class="invalid-feedback">' . session('errors.password') . '</div>' : '' ?>
                                </div>
                            </div>

                            <!-- Password Confirmation Field -->
                            <div class="form-group row">
                                <?= form_label('Confirm Password', 'password_confirm', ['class' => 'col-sm-3 col-form-label']) ?>
                                <div class="col-sm-9">
                                    <?= form_password([
                                        'name' => 'password_confirm',
                                        'id' => 'password_confirm',
                                        'class' => 'form-control' . (session('errors.password_confirm') ? ' is-invalid' : ''),
                                        'placeholder' => 'Confirm Password'
                                    ]) ?>
                                    <?= session('errors.password_confirm') ? '<div class="invalid-feedback">' . session('errors.password_confirm') . '</div>' : '' ?>
                                </div>
                            </div>
                        </div>
                        <!-- Form Footer -->
                        <div class="card-footer">
                            <?= form_submit('submit', 'Register', ['class' => 'btn btn-info']) ?>
                            <a href="<?= base_url('login') ?>" class="btn btn-default float-right">Already have an account?</a>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<script src="<?= base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js") ?>"></script>
<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
<?= $this->endSection() ?>
