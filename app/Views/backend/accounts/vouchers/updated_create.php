
<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Section Header -->
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>

    <!-- Main Content Section -->
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-info">
                    <div class="card-header">
                        <!-- Conditional Title: Add/Edit Voucher -->
                        <h3 class="card-title"><?= isset($voucher) ? 'Edit Voucher' : 'Create Voucher' ?></h3>
                    </div>

                    <!-- Form Start -->
                    <form action="<?= base_url('vouchers/' . (isset($voucher) ? 'update/' . $voucher['id'] : 'store')) ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="card-body">
                            <!-- Date Input -->
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" value="<?= set_value('date', isset($voucher) ? $voucher['date'] : date('Y-m-d')) ?>" required>
                            </div>

                            <!-- Voucher Type Dropdown -->
                            <div class="form-group">
                                <label for="voucher_type">Voucher Type</label>
                                <select name="voucher_type" id="voucher_type" class="form-control" required>
                                    <option value="" disabled <?= !isset($voucher) ? 'selected' : '' ?>>Select Voucher Type</option>
                                    <?php foreach ($voucher_types as $type): ?>
                                        <option value="<?= $type ?>" <?= set_select('voucher_type', $type, isset($voucher) && $voucher['voucher_type'] === $type) ?>><?= $type ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Reference Number Input -->
                            <div class="form-group">
                                <label for="reference_no">Reference No</label>
                                <input type="text" name="reference_no" id="reference_no" class="form-control" value="<?= set_value('reference_no', isset($voucher) ? $voucher['reference_no'] : '') ?>" required>
                            </div>

                            <!-- Ledger Dropdown -->
                            <div class="form-group">
                                <label for="ledger_id">Ledger</label>
                                <select name="ledger_id" id="ledger_id" class="form-control" required>
                                    <option value="" disabled <?= !isset($voucher) ? 'selected' : '' ?>>Select Ledger</option>
                                    <?php foreach ($ledgers as $ledger): ?>
                                        <option value="<?= $ledger['id'] ?>" <?= set_select('ledger_id', $ledger['id'], isset($voucher) && $voucher['ledger_id'] == $ledger['id']) ?>><?= $ledger['ledger_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Services/Stock Items Integration -->
                            <div class="form-group">
                                <label for="services_or_items">Services/Stock Items</label>
                                <select name="services_or_items[]" id="services_or_items" class="form-control select2" multiple required>
                                    <?php foreach (array_merge($services, $stock_items) as $item): ?>
                                        <option value="<?= $item['id'] ?>" <?= set_select('services_or_items[]', $item['id'], isset($selected_items) && in_array($item['id'], $selected_items)) ?>>
                                            <?= $item['item_name'] ?> - <?= $item['type'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="form-text text-muted">Hold Ctrl or Cmd to select multiple items.</small>
                            </div>

                            <!-- Debit and Credit Inputs -->
                            <div class="form-group">
                                <label for="debit">Debit</label>
                                <input type="number" step="0.01" name="debit" id="debit" class="form-control" value="<?= set_value('debit', isset($voucher) ? $voucher['debit'] : '') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="credit">Credit</label>
                                <input type="number" step="0.01" name="credit" id="credit" class="form-control" value="<?= set_value('credit', isset($voucher) ? $voucher['credit'] : '') ?>" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><?= isset($voucher) ? 'Update' : 'Create' ?></button>
                            <a href="<?= base_url('vouchers') ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
