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

                    <!-- Flash Message for Success -->
                    <?php if (session()->getFlashdata('swal_success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('swal_success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form Start -->
                    <?= form_open('vouchers/add-entry/' . $voucher_id, ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="entry_type">Entry Type</label>
                            <select id="entry_type" name="entry_type" class="form-control" required>
                                <option value="Ledger">Ledger</option>
                                <option value="Service">Service</option>
                                <option value="Inventory">Inventory</option>
                            </select>
                        </div>

                        <!-- Ledger Fields -->
                        <div id="ledger_fields" class="form-group">
                            <label for="ledger_id">Select Ledger</label>
                            <select name="related_id" class="form-control">
                                <?php foreach ($ledgers as $ledger): ?>
                                    <option value="<?= $ledger['id'] ?>"><?= $ledger['ledger_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Service Fields -->
                        <div id="service_fields" class="form-group" style="display: none;">
                            <label for="service_id">Select Service</label>
                            <select name="related_id" class="form-control">
                                <?php foreach ($services as $service): ?>
                                    <option value="<?= $service['id'] ?>"><?= $service['service_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" placeholder="Amount">
                        </div>

                        <!-- Inventory Fields -->
                        <div id="inventory_fields" class="form-group" style="display: none;">
                            <label for="stock_item_id">Select Inventory Item</label>
                            <select name="related_id" class="form-control">
                                <?php foreach ($stock_items as $item): ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['item_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                            <label for="rate">Rate</label>
                            <input type="number" name="rate" class="form-control" placeholder="Rate">
                        </div>

                        <!-- Debit and Credit -->
                        <div class="form-group">
                            <label for="debit">Debit</label>
                            <input type="number" name="debit" class="form-control" placeholder="Debit">
                        </div>
                        <div class="form-group">
                            <label for="credit">Credit</label>
                            <input type="number" name="credit" class="form-control" placeholder="Credit">
                        </div>
                    </div>
                    <div class="card-footer">
                        <?= form_submit('submit', 'Add Entry', ['class' => 'btn btn-info']) ?>
                        <a href="<?= base_url('vouchers/entry/' . $voucher_id) ?>" class="btn btn-default float-right">Cancel</a>
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
    document.getElementById('entry_type').addEventListener('change', function () {
        const type = this.value;
        document.getElementById('ledger_fields').style.display = type === 'Ledger' ? '' : 'none';
        document.getElementById('service_fields').style.display = type === 'Service' ? '' : 'none';
        document.getElementById('inventory_fields').style.display = type === 'Inventory' ? '' : 'none';
    });
</script>
<?= $this->endSection() ?>
