<?= $this->include("theme/idpcd_theme/header") ?>

<main>
    <h1><?= $title; ?></h1>

    <div class="categories">
        <h2>Categories</h2>
        <ul>
            <?php foreach ($categories as $category): ?>
                <li>
                    <a href="<?= base_url('/products/category/' . $category['id']); ?>">
                        <?= esc($category['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <?php if(isset($product['featured_image'])): ?>
                <img src="<?= base_url($product['featured_image']); ?>" alt="<?= esc($product['name']); ?>">
                <?php endif; ?>
                <h2><?= esc($product['name']); ?></h2>
                <p><?= esc($product['description']); ?></p>
                <p>Price: $<?= esc($product['price']); ?></p>
                <a href="<?= base_url('products/' . $product['id']); ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?= $this->include("theme/idpcd_theme/footer") ?>