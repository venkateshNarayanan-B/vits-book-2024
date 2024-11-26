<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Assign Permissions to Role: <?= esc($role['name']) ?></h3>
                    </div>

                    <?= form_open('permissions/assign/' . $role['id'], ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <?= form_label('Permissions', 'permissions', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?php foreach ($permissions as $permission): ?>
                                    <div class="form-check">
                                        <?= form_checkbox([
                                            'name' => 'permissions[]',
                                            'value' => $permission['id'],
                                            'checked' => in_array($permission['id'], $assigned_permissions),
                                            'class' => 'form-check-input'
                                        ]) ?>
                                        <?= form_label($permission['name'], '', ['class' => 'form-check-label']) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?= form_submit('submit', 'Assign Permissions', ['class' => 'btn btn-info']) ?>
                        <a href="<?= base_url('roles') ?>" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
