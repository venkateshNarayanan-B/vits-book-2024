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
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><?= isset($permission) ? 'Edit Permission Form' : 'Create Permission Form' ?></h3>
                    </div>

                    <!-- Form Start -->
                    <?= form_open(isset($permission) ? 'permissions/edit/' . $permission['id'] : 'permissions/create', ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <!-- Permission Name Field -->
                        <div class="form-group row">
                            <?= form_label('Permission Name', 'name', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'name',
                                    'value' => old('name', $permission['name'] ?? ''),
                                    'class' => 'form-control' . (session('errors.name') ? ' is-invalid' : ''),
                                    'placeholder' => 'Permission Name'
                                ]) ?>
                                <?= session('errors.name') ? '<div class="invalid-feedback">' . session('errors.name') . '</div>' : '' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer">
                        <?= form_submit('submit', isset($permission) ? 'Update' : 'Create', ['class' => 'btn btn-info']) ?>
                        <a href="<?= base_url('permissions') ?>" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
