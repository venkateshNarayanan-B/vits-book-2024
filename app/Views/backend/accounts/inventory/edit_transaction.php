<?= $this->extend('layout/backend/main') ?>

<?= $this->section("styles") ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Inventory Transaction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Accounts</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('inventory/transactions') ?>">Inventory Transactions</a></li>
                        <li class="breadcrumb-item active">Edit Transaction</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Transaction Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= base_url('inventory/transactions/update/' . $transaction['id']) ?>" method="POST">
                                <?= csrf_field() ?>

                                <!-- Date -->
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" class="form-control" id="date" value="<?= old('date', isset($transaction['date']) ? date('Y-m-d', strtotime($transaction['date'])) : '') ?>" required>
                                    <?php if (isset($errors['date'])): ?>
                                        <div class="text-danger"><?= $errors['date'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Item -->
                                <div class="form-group">
                                    <label for="stock_item_id">Stock Item</label>
                                    <select name="stock_item_id" class="form-control select2" id="stock_item_id" style="width: 100%;" required>
                                        <option value="">Select Item</option>
                                        <?php foreach ($items as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('stock_item_id', $transaction['stock_item_id']) == $item['id'] ? 'selected' : '' ?>><?= $item['item_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($errors['stock_item_id'])): ?>
                                        <div class="text-danger"><?= $errors['stock_item_id'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Quantity -->
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" id="quantity" value="<?= old('quantity', $transaction['quantity']) ?>" required step="any">
                                    <?php if (isset($errors['quantity'])): ?>
                                        <div class="text-danger"><?= $errors['quantity'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Transaction Type -->
                                <div class="form-group">
                                    <label for="transaction_type">Transaction Type</label>
                                    <select name="transaction_type" class="form-control" id="transaction_type" required>
                                        <option value="">Select Transaction Type</option>
                                        <option value="Inward" <?= old('transaction_type', $transaction['transaction_type']) == 'Inward' ? 'selected' : '' ?>>Inward</option>
                                        <option value="Outward" <?= old('transaction_type', $transaction['transaction_type']) == 'Outward' ? 'selected' : '' ?>>Outward</option>
                                    </select>
                                    <?php if (isset($errors['transaction_type'])): ?>
                                        <div class="text-danger"><?= $errors['transaction_type'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Transaction</button>
                                <a href="<?= base_url('inventory/transactions') ?>" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<!-- Select2 -->

<?= $this->endSection() ?>
