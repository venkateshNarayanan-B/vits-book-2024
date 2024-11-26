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
                        <h3 class="card-title"><?= isset($ledger) ? 'Edit Ledger' : 'Create Ledger' ?></h3>
                    </div>

                    <!-- Flash Message for Success -->
                    <?php if (session()->getFlashdata('swal_success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('swal_success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form Start -->
                    <?= form_open(isset($ledger) ? 'accounts/edit-ledger/' . $ledger['id'] : 'accounts/create-ledger', ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <?= form_label('Ledger Name', 'ledger_name', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'ledger_name',
                                    'value' => old('ledger_name', $ledger['ledger_name'] ?? ''),
                                    'class' => 'form-control' . (session('errors.ledger_name') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Ledger Name'
                                ]) ?>
                                <?= session('errors.ledger_name') ? '<div class="invalid-feedback">' . session('errors.ledger_name') . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?= form_label('Group', 'group_id', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_dropdown('group_id', array_column($groups, 'group_name', 'id'), old('group_id', $ledger['group_id'] ?? null), ['class' => 'form-control']) ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?= form_label('Opening Balance', 'opening_balance', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'opening_balance',
                                    'value' => old('opening_balance', $ledger['opening_balance'] ?? '0.00'),
                                    'class' => 'form-control' . (session('errors.opening_balance') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Opening Balance'
                                ]) ?>
                                <?= session('errors.opening_balance') ? '<div class="invalid-feedback">' . session('errors.opening_balance') . '</div>' : '' ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?= form_submit('submit', isset($ledger) ? 'Update Ledger' : 'Create Ledger', ['class' => 'btn btn-info']) ?>
                        <a href="<?= base_url('accounts') ?>" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
