<?= $this->extend("theme/farmix/index") ?>

<?= $this->section('content') ?>
<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/breadcumb/breadcumb-bg.png">
    <div class="container z-index-common">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Our Products</h1>
        </div>
        <div class="breadcumb-menu-wrap">
            <ul class="breadcumb-menu">
                <li><a href="<?= base_url('/') ?>">Home</a></li>
                <li>Our Products</li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
Products area
============================== -->
<section class="products space">
    <div class="container">
        <div class="vs-sort-bar">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-auto">
                    <div class="col-auto">
                        <p class="woocommerce-result-count">Showing 1–12 of 13 results</p>
                    </div>
                </div>
                <div class="col-md-auto">
                    <div class="row justify-content-center">
                        <div class="col-sm-auto">
                            <form class="woocommerce-ordering" method="get">
                                <select name="orderby" class="orderby" aria-label="Shop order">
                                    <option value="menu_order" selected="selected">Default Sorting</option>
                                    <option value="date">Sort by latest</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $productList = get_category_product_list($category['id']);
            ?>
            <?php if(!empty($productList)): ?>
            <?php foreach($productList as $product): ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
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
            <?php endif; ?>
        </div>
        <div class="vs-pagination text-center mb-0 mt-4">
            <ul>
                <li class="arrow"><a href="#"><i class="fal fa-long-arrow-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">6</a></li>
                <li class="arrow"><a href="#"><i class="fal fa-long-arrow-right"></i></a></li>
            </ul>
        </div>
    </div>
</section>
<!--==============================
Offer Area
============================== -->
<div class="space-bottom">
    <div class="container">
        <div class="row">
            <div class="offer-deal">
                <div class="row gy-5 gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="row align-items-center" data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/about/about-bg-1-2.jpg">
                            <div class="col-lg-6 col-md-6 px-0">
                                <div class="deal-offer white-style">
                                    <span class="offer-subtitle">Enjoy Healthy Food</span>
                                    <h2 class="offer-title h3">Eat Organic</h2>
                                    <p class="offer-text">100% Natural and pure organic products</p>
                                    <span class="price"> <del>$18.00</del>$14.00</span>
                                    <a href="blog.html" class="vs-btn">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 px-0">
                                <div class="offer-img">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-offer1.png" alt="offer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row align-items-center" data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/about/about-bg-1-1.jpg">
                            <div class="col-lg-6 col-md-6 px-0">
                                <div class="deal-offer">
                                    <span class="offer-subtitle">Organic Deal</span>
                                    <h2 class="offer-title h3">Pack of 2</h2>
                                    <p class="offer-text">100% Natural and pure organic products</p>
                                    <span class="price"> <del>$18.00</del>$14.00</span>
                                    <a href="blog.html" class="vs-btn">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 px-0">
                                <div class="offer-img">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-offer1.png" alt="offer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>