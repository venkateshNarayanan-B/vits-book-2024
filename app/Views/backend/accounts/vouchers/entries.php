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

                    

                    <div class="card-body">
                        <!-- Link to add a new entry -->
                        <a href="<?= site_url('vouchers/add-entry/' . $voucher_id) ?>" class="btn btn-info mb-3">Add New Entry</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Ledger</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($entries)): ?>
                                    <tr>
                                        <td colspan="4">No entries found for this voucher.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($entries as $entry): ?>
                                    <tr>
                                        <td><?= esc($entry['ledger_name']) ?></td>
                                        <td><?= esc($entry['debit']) ?></td>
                                        <td><?= esc($entry['credit']) ?></td>
                                        <td>
                                            <a href="<?= site_url('vouchers/edit-entry/' . $entry['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?= site_url('vouchers/delete-entry/' . $entry['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
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
