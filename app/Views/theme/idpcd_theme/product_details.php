
<?= $this->include("theme/idpcd_theme/header") ?>
<main>
    <h1><?= $title; ?></h1>

    <div class="product-images">
        <?php foreach ($images as $image): ?>
            <img src="<?= base_url($image['image_path']); ?>" alt="<?= esc($product['name']); ?>">
        <?php endforeach; ?>
    </div>

    <div class="product-details">
        <p><?= esc($product['description']); ?></p>
        <p>Price: $<?= esc($product['price']); ?></p>
    </div>

    <div class="product-specifications">
        <h2>Specifications</h2>
        <ul>
            <?php foreach ($specifications as $spec): ?>
                <li><?= esc($spec['specification_key']); ?>: <?= esc($spec['specification_value']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>
<?= $this->include("theme/idpcd_theme/footer") ?>
