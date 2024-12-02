<div class="container">
    <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
        <div class="title-img">
            <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/title-logo.png" alt="title logo">
        </div>
        <span class="sec-subtitle">Our Products</span>
        <h2 class="sec-title">Organic Products</h2>
    </div>
    <div class="row vs-carousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-autoplay="true" data-arrows="false" data-dots="true" data-center-mode="true">
    <?php
    $productList = get_product_list();
    ?>
    <?php foreach($productList as $product): ?>
        <div class="col-lg-3">
            <div class="product-style1">
                <div class="product-img">
                    <img src="<?= base_url($product['featured_image']) ?>" alt="product img">
                </div>
                <div class="product-meta">30% Off</div>
                <div class="product-about">
                    
                    <h2 class="product-title"><a href="<?= base_url('products/'.$product['slug']) ?>"><?= $product['name'] ?></a></h2>
                    <span class="price"> &#8377; <?= $product['price'] ?></span>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="social-style">
                    <ul>
                        <li>
                            <a class="main-icon" href="<?= base_url('products/'.$product['slug']) ?>"><i class="far fa-shopping-basket"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach; ?>  
    </div>
</div>