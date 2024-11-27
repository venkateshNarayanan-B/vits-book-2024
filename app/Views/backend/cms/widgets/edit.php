<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= esc($page_title) ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= esc($page_title) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= esc($page_title) ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url("cms/widgets/update/{$placement['id']}/{$layoutId}") ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="widget_id">Select Widget</label>
                            <select name="widget_id" id="widget_id" class="form-control select2">
                                <?php foreach ($contentBlocks as $block): ?>
                                    <option value="<?= esc($block['id']) ?>" <?= $block['id'] == $placement['widget_id'] ? 'selected' : '' ?>>
                                        <?= esc($block['title']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php
                        $widgetsConfig = new \Config\Widgets();
                        $positions = $widgetsConfig->positions;
                        ?>

                        <div class="form-group">
                            <label for="position">Position</label>
                            <select name="position" id="position" class="form-control select2">
                                <?php foreach ($positions as $key => $name): ?>
                                    <option value="<?= $key ?>" <?= $placement['position'] == $key ? 'selected' : '' ?>>
                                        <?= ucfirst($name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Update Placement</button>
                        <a href="<?= base_url("cms/widgets/{$layoutId}") ?>" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
