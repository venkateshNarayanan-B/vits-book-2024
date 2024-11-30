
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

    <form action="<?= base_url('submit-enquiry') ?>" method="post">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Enquiry</button>
    </form>
</main>
<?= $this->include("theme/idpcd_theme/footer") ?>
