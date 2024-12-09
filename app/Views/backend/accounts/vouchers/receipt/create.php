<?= $this->extend('layout/backend/main') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><?= esc($title) ?></h3>
                    </div>

                    <!-- Flash Message for Errors -->
                    <?php if (session()->getFlashdata('validation')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session()->getFlashdata('validation') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?= form_open('receipt-vouchers/store', ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <!-- Date -->
                        <div class="form-group row">
                            <?= form_label('Date', 'date', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'date',
                                    'value' => old('date'),
                                    'class' => 'form-control' . (session('errors.date') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Date',
                                    'type' => 'date',
                                ]) ?>
                                <?= session('errors.date') ? '<div class="invalid-feedback">' . session('errors.date') . '</div>' : '' ?>
                            </div>
                        </div>

                        <!-- Reference No -->
                        <div class="form-group row">
                            <?= form_label('Reference No', 'reference_no', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'reference_no',
                                    'value' => old('reference_no'),
                                    'class' => 'form-control' . (session('errors.reference_no') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Reference Number',
                                ]) ?>
                                <?= session('errors.reference_no') ? '<div class="invalid-feedback">' . session('errors.reference_no') . '</div>' : '' ?>
                            </div>
                        </div>

                        <!-- Voucher Entries -->
                        <div class="form-group row">
                            <?= form_label('Entries', '', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <div id="voucher-entries">
                                    <div class="entry mb-3">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Ledger</label>
                                            <div class="col-sm-9">
                                                <select name="entries[0][ledger_id]" class="form-control select2">
                                                    <option value="">Select Ledger</option>
                                                    <?php foreach ($ledgers as $ledger): ?>
                                                        <option value="<?= esc($ledger['id']) ?>"><?= esc($ledger['ledger_name']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Debit</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="entries[0][debit]" class="form-control" placeholder="Debit" step="0.01" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-entry" class="btn btn-secondary mt-3">Add Entry</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?= form_submit('submit', 'Create Receipt Voucher', ['class' => 'btn btn-info']) ?>
                        <a href="<?= site_url('receipt-vouchers') ?>" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        let entryCount = 1;

        $('#add-entry').on('click', function () {
            const entryDiv = `
                <div class="entry mb-3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Ledger</label>
                        <div class="col-sm-9">
                            <select name="entries[${entryCount}][ledger_id]" class="form-control select2">
                                <option value="">Select Ledger</option>
                                <?php foreach ($ledgers as $ledger): ?>
                                    <option value="<?= esc($ledger['id']) ?>"><?= esc($ledger['ledger_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Debit</label>
                        <div class="col-sm-9">
                            <input type="number" name="entries[${entryCount}][debit]" class="form-control" placeholder="Debit" step="0.01" required>
                        </div>
                    </div>
                </div>`;
            $('#voucher-entries').append(entryDiv);
            entryCount++;
        });

        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });
</script>
<?= $this->endSection() ?>
