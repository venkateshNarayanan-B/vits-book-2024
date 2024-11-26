<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><?= isset($user) ? 'Edit User' : 'Create User' ?></h3>
                    </div>

                    <!-- Form Start -->
                    <?= form_open(isset($user) ? 'user/edit/' . $user['id'] : 'user/create', ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <!-- Name Field -->
                        <div class="form-group row">
                            <?= form_label('Name', 'name', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'name',
                                    'value' => old('name', $user['name'] ?? ''),
                                    'class' => 'form-control' . (session('errors.name') ? ' is-invalid' : ''),
                                    'placeholder' => 'Full Name'
                                ]) ?>
                                <?= session('errors.name') ? '<div class="invalid-feedback">' . session('errors.name') . '</div>' : '' ?>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group row">
                            <?= form_label('Email', 'email', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'type' => 'email',
                                    'name' => 'email',
                                    'value' => old('email', $user['email'] ?? ''),
                                    'class' => 'form-control' . (session('errors.email') ? ' is-invalid' : ''),
                                    'placeholder' => 'Email Address'
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
                                    'class' => 'form-control' . (session('errors.password') ? ' is-invalid' : ''),
                                    'placeholder' => isset($user) ? 'Leave blank to keep current password' : 'Password'
                                ]) ?>
                                <?= session('errors.password') ? '<div class="invalid-feedback">' . session('errors.password') . '</div>' : '' ?>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group row">
                            <?= form_label('Confirm Password', 'password_confirm', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_password([
                                    'name' => 'password_confirm',
                                    'class' => 'form-control' . (session('errors.password_confirm') ? ' is-invalid' : ''),
                                    'placeholder' => isset($user) ? 'Leave blank to keep current password' : 'Confirm Password'
                                ]) ?>
                                <?= session('errors.password_confirm') ? '<div class="invalid-feedback">' . session('errors.password_confirm') . '</div>' : '' ?>
                            </div>
                        </div>

                        <!-- Roles Field -->
                        <!-- Roles Field -->
                        <div class="form-group row">
                            <?= form_label('Roles', 'roles', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?php foreach ($roles as $role): ?>
                                    <div class="form-check">
                                        <?= form_radio('roles', $role['id'], (isset($assignedRoles) && in_array($role['id'], $assignedRoles)), ['class' => 'form-check-input', 'id' => 'role_' . $role['id']]) ?>
                                        <?= form_label($role['name'], 'role_' . $role['id'], ['class' => 'form-check-label']) ?>
                                    </div>
                                <?php endforeach; ?>
                                <?= session('errors.roles') ? '<div class="invalid-feedback d-block">' . session('errors.roles') . '</div>' : '' ?>
                            </div>
                        </div>

                    <!-- Card Footer -->
                    <div class="card-footer">
                        <?= form_submit('submit', isset($user) ? 'Update' : 'Create', ['class' => 'btn btn-info']) ?>
                        <a href="<?= base_url('user') ?>" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
