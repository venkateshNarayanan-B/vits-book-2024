<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>

    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
            </div>
            <?= form_open('backend/accounts/inventory/categories/update/' . $category['id'], ['class' => 'form-horizontal']) ?>
            <div class="card-body">
                <div class="form-group row">
                    <?= form_label('Category Name', 'category_name', ['class' => 'col-sm-3 col-form-label']) ?>
                    <div class="col-sm-9">
                        <?= form_input([
                            'name' => 'category_name',
                            'value' => old('category_name', $category['category_name']),
                            'class' => 'form-control' . (session('errors.category_name') ? ' is-invalid' : ''),
                            'placeholder' => 'Enter category name',
                        ]) ?>
                        <?= session('errors.category_name') ? '<div class="invalid-feedback">' . session('errors.category_name') . '</div>' : '' ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?= form_submit('submit', 'Update', ['class' => 'btn btn-info']) ?>
                <a href="<?= base_url('backend/accounts/inventory/categories') ?>" class="btn btn-default float-right">Cancel</a>
            </div>
            <?= form_close() ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
