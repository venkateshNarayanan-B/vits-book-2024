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
                        <h3 class="card-title"><?= isset($group) ? 'Edit Group' : 'Create Group' ?></h3>
                    </div>

                    <!-- Flash Message for Success -->
                    <?php if (session()->getFlashdata('swal_success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('swal_success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form Start -->
                    <?= form_open(isset($group) ? 'accounts/edit-group/' . $group['id'] : 'accounts/create-group', ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <?= form_label('Group Name', 'group_name', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'group_name',
                                    'value' => old('group_name', $group['group_name'] ?? ''),
                                    'class' => 'form-control' . (session('errors.group_name') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Group Name'
                                ]) ?>
                                <?= session('errors.group_name') ? '<div class="invalid-feedback">' . session('errors.group_name') . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?= form_label('Parent Group', 'parent_group_id', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_dropdown('parent_group_id', array_column($groups, 'group_name', 'id'), old('parent_group_id', $group['parent_group_id'] ?? null), ['class' => 'form-control']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?= form_submit('submit', isset($group) ? 'Update Group' : 'Create Group', ['class' => 'btn btn-info']) ?>
                        <a href="<?= base_url('accounts') ?>" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
