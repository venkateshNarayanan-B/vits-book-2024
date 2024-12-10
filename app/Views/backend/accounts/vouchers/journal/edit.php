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

                    <?= form_open('journal-vouchers/update/' . $voucher['id'], ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <!-- Date -->
                        <div class="form-group row">
                            <?= form_label('Date', 'date', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'date',
                                    'value' => old('date', date('Y-m-d', strtotime($voucher['date']))),
                                    'class' => 'form-control' . (session('errors.date') ? ' is-invalid' : ''),
                                    'type' => 'date',
                                    'required' => true,
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
                                    'value' => old('reference_no', $voucher['reference_no']),
                                    'class' => 'form-control' . (session('errors.reference_no') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Reference Number',
                                    'required' => true,
                                ]) ?>
                                <?= session('errors.reference_no') ? '<div class="invalid-feedback">' . session('errors.reference_no') . '</div>' : '' ?>
                            </div>
                        </div>

                        <!-- Debit Ledger -->
                        <div class="form-group row">
                            <?= form_label('Debit Ledger', 'debit_ledger', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <select name="debit_ledger" class="form-control select2" required>
                                    <option value="">Select Debit Ledger</option>
                                    <?php foreach ($ledgers as $ledger): ?>
                                        <option value="<?= esc($ledger['id']) ?>" <?= old('debit_ledger', $entries[1]['ledger_id']) == $ledger['id'] ? 'selected' : '' ?>>
                                            <?= esc($ledger['ledger_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= session('errors.debit_ledger') ? '<div class="invalid-feedback">' . session('errors.debit_ledger') . '</div>' : '' ?>
                            </div>
                        </div>

                        <!-- Credit Ledger -->
                        <div class="form-group row">
                            <?= form_label('Credit Ledger', 'credit_ledger', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <select name="credit_ledger" class="form-control select2" required>
                                    <option value="">Select Credit Ledger</option>
                                    <?php foreach ($ledgers as $ledger): ?>
                                        <option value="<?= esc($ledger['id']) ?>" <?= old('credit_ledger', $entries[0]['ledger_id']) == $ledger['id'] ? 'selected' : '' ?>>
                                            <?= esc($ledger['ledger_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= session('errors.credit_ledger') ? '<div class="invalid-feedback">' . session('errors.credit_ledger') . '</div>' : '' ?>
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="form-group row">
                            <?= form_label('Amount', 'amount', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'amount',
                                    'value' => old('amount', $entries[1]['debit'] ?? 0), // Fetch debit value
                                    'class' => 'form-control' . (session('errors.amount') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Amount',
                                    'type' => 'number',
                                    'step' => '0.01',
                                    'required' => true,
                                ]) ?>
                                <?= session('errors.amount') ? '<div class="invalid-feedback">' . session('errors.amount') . '</div>' : '' ?>
                                <small class="form-text text-muted">Debit and Credit amounts must be the same.</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?= form_submit('submit', 'Update Journal Voucher', ['class' => 'btn btn-info']) ?>
                        <a href="<?= site_url('journal-vouchers') ?>" class="btn btn-default float-right">Cancel</a>
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
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        // Prevent selecting the same ledger for Debit and Credit
        $('select[name="debit_ledger"], select[name="credit_ledger"]').change(function () {
            const debitLedger = $('select[name="debit_ledger"]').val();
            const creditLedger = $('select[name="credit_ledger"]').val();

            if (debitLedger && debitLedger === creditLedger) {
                alert("Debit and Credit ledgers cannot be the same.");
                $(this).val('').trigger('change');
            }
        });
    });
</script>
<?= $this->endSection() ?>
