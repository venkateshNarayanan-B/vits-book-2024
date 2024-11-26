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
                        <h3 class="card-title">Edit Voucher</h3>
                    </div>

                    <!-- Flash Message for Success -->
                    <?php if (session()->getFlashdata('swal_success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('swal_success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form Start -->
                    <?= form_open('vouchers/update/' . $voucher['id'], ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <?= form_label('Voucher Date', 'date', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'date',
                                    'type' => 'date',
                                    'value' => old('date', isset($voucher['date']) ? date('Y-m-d', strtotime($voucher['date'])) : ''),
                                    'class' => 'form-control' . (session('errors.date') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Voucher Date'
                                ]) ?>
                                <?= session('errors.date') ? '<div class="invalid-feedback">' . session('errors.date') . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?= form_label('Voucher Type', 'voucher_type', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_dropdown('voucher_type', ['' => 'Select Type', 'Sales' => 'Sales', 'Purchase' => 'Purchase', 'Receipt' => 'Receipt', 'Payment' => 'Payment', 'Contra' => 'Contra', 'Journal' => 'Journal'], old('voucher_type', $voucher['voucher_type']), ['class' => 'form-control' . (session('errors.voucher_type') ? ' is-invalid' : '')]) ?>
                                <?= session('errors.voucher_type') ? '<div class="invalid-feedback">' . session('errors.voucher_type') . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?= form_label('Reference No', 'reference_no', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <?= form_input([
                                    'name' => 'reference_no',
                                    'value' => old('reference_no', $voucher['reference_no']),
                                    'class' => 'form-control' . (session('errors.reference_no') ? ' is-invalid' : ''),
                                    'placeholder' => 'Enter Reference Number'
                                ]) ?>
                                <?= session('errors.reference_no') ? '<div class="invalid-feedback">' . session('errors.reference_no') . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?= form_label('Entries', '', ['class' => 'col-sm-3 col-form-label']) ?>
                            <div class="col-sm-9">
                                <div id="voucher-entries">
                                    <?php foreach ($entries as $key => $entry): ?>
                                        <div class="entry mb-3">
                                            <!-- Ledger dropdown in its own row -->
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Ledger</label>
                                                <div class="col-sm-9">
                                                    <select name="entries[<?= $key ?>][ledger_id]" class="form-control select2">
                                                        <option value="">Select Ledger</option>
                                                        <?php foreach ($ledgers as $ledger): ?>
                                                            <option value="<?= esc($ledger['id']) ?>" <?= $entry['ledger_id'] == $ledger['id'] ? 'selected' : '' ?>>
                                                                <?= esc($ledger['ledger_name']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Debit and Credit inputs in the same row -->
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Debit</label>
                                                <div class="col-sm-3">
                                                    <input type="number" name="entries[<?= $key ?>][debit]" value="<?= esc($entry['debit']) ?>" class="form-control" placeholder="Debit" step="0.01">
                                                </div>

                                                <label class="col-sm-3 col-form-label">Credit</label>
                                                <div class="col-sm-3">
                                                    <input type="number" name="entries[<?= $key ?>][credit]" value="<?= esc($entry['credit']) ?>" class="form-control" placeholder="Credit" step="0.01">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" id="add-entry" class="btn btn-secondary mt-3">Add Entry</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?= form_submit('submit', 'Update Voucher', ['class' => 'btn btn-info']) ?>
                        <a href="<?= base_url('vouchers') ?>" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('add-entry').addEventListener('click', function () {
        const entryCount = document.querySelectorAll('#voucher-entries .entry').length;
        const entryDiv = document.createElement('div');
        entryDiv.classList.add('entry', 'd-flex', 'flex-column', 'mb-3');

        entryDiv.innerHTML = `
            <!-- Ledger dropdown in its own row -->
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
            
            <!-- Debit and Credit inputs in the same row -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Debit</label>
                <div class="col-sm-3">
                    <input type="number" name="entries[${entryCount}][debit]" class="form-control" placeholder="Debit" step="0.01">
                </div>

                <label class="col-sm-3 col-form-label">Credit</label>
                <div class="col-sm-3">
                    <input type="number" name="entries[${entryCount}][credit]" class="form-control" placeholder="Credit" step="0.01">
                </div>
            </div>
        `;

        document.getElementById('voucher-entries').appendChild(entryDiv);
        //$('.select2').select2();  // Reinitialize select2 for the new dropdown
        $(entryDiv.querySelector('select')).select2({
            theme: 'bootstrap4'  // Apply Bootstrap4 theme to the new Select2 dropdown
        });
    });

    // Initialize Select2 for all select elements
    
</script>

<?= $this->endSection() ?>
