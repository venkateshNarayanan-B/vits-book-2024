<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><?= esc($page_title) ?></h3>
                    </div>

                    <!-- Flash Message for Success -->
                    <?php if (session()->getFlashdata('swal_success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('swal_success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <a href="<?= site_url('vouchers/create') ?>" class="btn btn-info mb-3">Create New Voucher</a>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Voucher Type</th>
                                    <th>Reference No</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($vouchers)): ?>
                                    <tr>
                                        <td colspan="4">No vouchers found</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($vouchers as $voucher): ?>
                                    <tr>
                                        <td><?= esc($voucher['date']) ?></td>
                                        <td><?= esc($voucher['voucher_type']) ?></td>
                                        <td><?= esc($voucher['reference_no']) ?></td>
                                        <td>
                                            <a href="<?= site_url('vouchers/entry/' . $voucher['id']) ?>" class="btn btn-success btn-sm">View Entry</a>
                                            <a href="<?= site_url('vouchers/edit/' . $voucher['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="<?= site_url('vouchers/delete/' . $voucher['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
