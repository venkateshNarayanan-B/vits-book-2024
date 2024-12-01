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
                <li><a href="index.html">Home</a></li>
                <li>Our Products</li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
Products-details area
============================== -->
<div class="vs-product-wrapper product-details space-top space-extra-bottom">
    <div class="container">
        <div class="row g-5">
        <div class="col-lg-6">
            <div class="product-slide-row row">
            <div class="col-lg-2 col-md-3">
                <div class="product-thumb-slide vs-carousel" data-slide-show="6" data-md-slide-show="3" data-sm-slide-show="3" data-xs-slide-show="3" data-asnavfor=".product-big-img" data-vertical="true" data-md-vertical="true" data-sm-vertical="false">
                    <div>
                        <div class="thumb"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-1.png" alt="Product Image"></div>
                    </div>
                    <div>
                        <div class="thumb"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-2.png" alt="Product Image"></div>
                    </div>
                    <div>
                        <div class="thumb"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-3.png" alt="Product Image"></div>
                    </div>
                    <div>
                        <div class="thumb"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-4.png" alt="Product Image"></div>
                    </div>
                    <div>
                        <div class="thumb"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-5.png" alt="Product Image"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-9">
                <div class="product-big-img vs-carousel" data-slide-show="1" data-fade="true" data-asnavfor=".product-thumb-slide">
                    <div class="img"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-1.png" alt="Product Image"></div>
                    <div class="img"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-2.png" alt="Product Image"></div>
                    <div class="img"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-3.png" alt="Product Image"></div>
                    <div class="img"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-4.png" alt="Product Image"></div>
                    <div class="img"><img src="<?= base_url('themes/farmix/') ?>assets/img/product/product-d-1-5.png" alt="Product Image"></div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="product-about">
            <div class="product-rating">
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <span class="product-rating__total">Review (03)</span>
                <span class="available"><i class="far fa-check"></i>Available</span>
            </div>
            <h2 class="product-title">Coconut Oil Jar</h2>
            <div class="actions">
                <div class="quantity">
                    <div class="quantity__field quantity-container">
                    <input type="number" id="quantity" class="qty-input" step="1" min="1" max="100" name="quantity" value="01" title="Qty">
                    <div class="quantity__buttons">
                        <button class="quantity-plus qty-btn"><i class="fal fa-plus"></i></button>
                        <button class="quantity-minus qty-btn"><i class="fal fa-minus"></i></button>
                    </div>
                    </div>
                </div>
                <p class="product-price">$155.00 <del>$23.85</del></p>
                <p>Free Shipping On This Item</p>
                <a href="cart.html" class="vs-btn"><i class="far fa-shopping-basket"></i>Add to Cart</a>
                <a href="#" class="icon-btn"><i class="far fa-heart"></i></a>
            </div>
            <div class="product_meta">
                <span class="sku_wrapper">
                <p>SKU:</p> <span class="sku">#WE443</span>
                </span>
                <span class="posted_in">
                <p>Category:</p> <a href="#" rel="tag">organic , </a><a href="#" rel="tag"> food , </a> <a href="#" rel="tag"> natural</a>
            </span>
            </div>
            <div class="shep-img">
                <img src="<?= base_url('themes/farmix/') ?>assets/img/service/selling-img-1-2.png" alt="selling-img">
            </div>
            </div>
        </div>
        </div>
        <div class="product-description">
        <div class="product-description__tab">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-information-tab" data-bs-toggle="pill" data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information" aria-selected="false">Additional Information</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Reviews (03)</button>
            </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="description">
                <h3 class="description-title h5">description</h3>
                <p class="text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit ame
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="text mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod
                orci. Cum
                sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum ultricies
                aliquam. Done ultricies nec, pellent, consectetur adipiscing elit. Ieuismod orci. Cum sociis natoque
                penatibus et magnis dis parturient montes
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod orci</p>
                    
                <div class="d-flex mb-5">
                    <div class="list-style1 me-5">
                        <h3 class="description-title h5">Love veg, not waste</h3>
                        <ul class="list-unstyled">
                            <li><span class="icon"><i class="far fa-check-circle"></i></span>Before you can dive-in to creating an effective user experience</li>
                            <li><span class="icon"><i class="far fa-check-circle"></i></span>intuitive user experience for your users online.</li>
                            <li><span class="icon"><i class="far fa-check-circle"></i></span>Videos within it, each element influences</li>
                        </ul>
                    </div>
                    <div class="list-style1">
                        <h3 class="description-title h5">Love veg, not waste</h3>
                        <ul class="list-unstyled">
                            <li><span class="icon"><i class="far fa-check-circle"></i></span>Before you can dive-in to creating an effective user experience</li>
                            <li><span class="icon"><i class="far fa-check-circle"></i></span>intuitive user experience for your users online.</li>
                            <li><span class="icon"><i class="far fa-check-circle"></i></span>Videos within it, each element influences</li>
                        </ul>
                    </div>
                </div>
                <div class="description-img">
                    <img src="<?= base_url('themes/farmix/') ?>assets/img/bg/product-details-bg.jpg" alt="product-details">
                </div>
                
            </div>
            </div>
            <div class="tab-pane fade" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
            <div class="product-information">
                <h3 class="description-title h5">Additional Information</h3>
                <table class="product-information__item table">
                    <tbody>
                        <tr>
                        <th class="product-information__name" scope="row">Type</th>
                        <td>Veg Box, Organic</td>
                        </tr>
                        <tr>
                        <th class="product-information__name" scope="row">Size</th>
                        <td>400ml</td>
                        </tr>
                        <tr>
                        <th class="product-information__name" scope="row">Brand</th>
                        <td colspan="2">Fosroc</td>
                        </tr>
                        <tr>
                        <th class="product-information__name" scope="row">Organic</th>
                        <td colspan="2">100%</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <h3 class="description-title h5">Reviews</h3>
            <div class="row woocommerce-reviews">
                <h2 class="h5 mt-4">0.5 Reviews</h2>
                <div class="product-rating">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="product-rating__total">Review (03)</span>
                </div>
                <div class="col-lg-6">
                    <div class="vs-comments-wrap">
                        <ul class="comment-list">
                            <li class="review vs-comment-item">
                            <div class="vs-post-comment">
                                <div class="comment-avater">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/blog/comment-author-1.jpg" alt="Comment Author">
                                </div>
                                <div class="comment-content">
                                <div class="comment-content__header">
                                    <div class="review-rating">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    </div>
                                    <h4 class="name h4">Thomas Walkar</h4>
                                    <span class="commented-on"><i class="fal fa-calendar-alt"></i> 22 April, 2022</span>
                                </div>
                                <p class="text">Delivered ye sportsmen zealously arranging frankness estimabl
                                    any article enabled musical shyness yet sixteen. </p>
                                </div>
                            </div>
                            </li>
                            <li class="review vs-comment-item">
                            <div class="vs-post-comment">
                                <div class="comment-avater">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/blog/comment-author-2.jpg" alt="Comment Author">
                                </div>
                                <div class="comment-content">
                                <div class="comment-content__header">
                                    <div class="review-rating">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    </div>
                                    <h4 class="name h4">Crish Thomas</h4>
                                    <span class="commented-on"><i class="fal fa-calendar-alt"></i> 22 April, 2022</span>
                                </div>
                                <p class="text">Delivered ye sportsmen zealously arranging frankness estimabl
                                    any article enabled musical shyness yet sixteen. </p>
                                </div>
                            </div>
                            </li>
                            <li class="review vs-comment-item">
                            <div class="vs-post-comment">
                                <div class="comment-avater">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/blog/comment-author-3.jpg" alt="Comment Author">
                                </div>
                                <div class="comment-content">
                                <div class="comment-content__header">
                                    <div class="review-rating">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    </div>
                                    <h4 class="name h4">Millem Jakson</h4>
                                    <span class="commented-on"><i class="fal fa-calendar-alt"></i> 23 April, 2022</span>
                                </div>
                                <p class="text">Delivered ye sportsmen zealously arranging frankness estimabl
                                    any article enabled musical shyness yet sixteen. </p>
                                </div>
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vs-comment-form review-form">
                        <div id="respond" class="comment-respond">
                            <div class="form-title mb-4">
                            <h3 class="description-title h5">Post Review</h3>
                            <div class="rating-select">
                                <label>Your Rating</label>
                                <p class="stars">
                                <span>
                                <a class="star-1" href="#">1</a>
                                <a class="star-2" href="#">2</a>
                                <a class="star-3" href="#">3</a>
                                <a class="star-4" href="#">4</a>
                                <a class="star-5" href="#">5</a>
                                </span>
                                </p>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                <input type="text" class="form-control" placeholder="Complete Name">
                                </div>
                                <div class="col-md-12 form-group">
                                <input type="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="col-12 form-group">
                                <textarea class="form-control" placeholder="Review"></textarea>
                                </div>
                                <div class="col-12 form-group mb-0">
                                <div class="custom-checkbox notice">
                                    <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
                                    <label for="wp-comment-cookies-consent"> Save my name, email, and website in this browser for
                                    the next time I comment.</label>
                                </div>
                                <button class="vs-btn"> <span class="vs-btn__bar"></span>Submit</button>
                                </div>
                            </div>
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