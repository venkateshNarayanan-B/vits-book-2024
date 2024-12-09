<?= $this->extend("theme/farmix/index") ?>

<?= $this->section('content') ?>
<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/breadcumb/breadcumb-bg.png">
    <div class="container z-index-common">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">About Us</h1>
        </div>
        <div class="breadcumb-menu-wrap">
            <ul class="breadcumb-menu">
                <li><a href="index.html">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
</div>

<!--==============================
About Area
============================== -->
<section class="about-layout1 space-top">
    <div class="container">
        <div class="row gx-5 justify-content-end">
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/about-1-1.jpg" alt="about-image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="title-area wow fadeInUp wow-animated" data-wow-delay="0.3s">
                        <span class="sec-subtitle">Welcome to Farmix</span>
                        <h2 class="sec-title">Agriculture & Organic Product Farm</h2>
                    </div>
                    <p class="about-text">Lorem ipsum dolor sit amet, porro quisquam est, qui dolorem ipsum
                        quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam
                        eius modi tempora incidunt ut quaerat voluptatem.
                    </p>
                </div>
                <div class="auther-info">
                    <div class="auther-inner">
                        <div class="auther-img">
                            <img src="<?= base_url('themes/farmix/') ?>assets/img/about/about-author.png" alt="about">
                        </div>
                        <div class="auther-content">
                            <h6 class="name">Thomas Walkar</h6>
                            <span class="designation">founde - CEO</span>
                        </div>
                    </div>
                    <div class="author-signature">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/about/about-signature.png" alt="about-signature">
                    </div>
                </div>
            </div>
            <div class="col-xl-10 col-lg-12 col-md-12">
                <div class="about-bottom">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="item-img">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/about/about-1-2.jpg" alt="about img">
                                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn popup-video">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="about-style1 border1">
                                <div class="about-inner">
                                    <div class="about-icon"><img src="<?= base_url('themes/farmix/') ?>assets/img/icon/about-icon-1-1.png" alt="icon"></div>
                                    <h3 class="about-title"><a href="service-details.html">100% Guaranteed Organic Product</a></h3>
                                    <p class="about-text">Lorem ipsum dolor sit amet, porro quisquam est, qui.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="about-style1">
                                <div class="about-inner">
                                    <div class="about-icon"><img src="<?= base_url('themes/farmix/') ?>assets/img/icon/about-icon-1-2.png" alt="icon"></div>
                                    <h3 class="about-title"><a href="service-details.html">Top-Quality Healthy Foods Production</a></h3>
                                    <p class="about-text">Lorem ipsum dolor sit amet, porro quisquam est, qui.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shape-mockup moving z-index-n1 d-none d-lg-block" style="right: 9%; bottom: 22%;"><img src="<?= base_url('themes/farmix/') ?>assets/img/shep/about-shep-1.png" alt="shapes"></div>
</section>
<!--==============================
Process Area
============================== -->
<section class="process-layout1 space">
    <div class="container">
        <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
            <div class="title-img">
                <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/title-logo.png" alt="title logo">
            </div>
            <span class="sec-subtitle">Welcome to Farmix</span>
            <h2 class="sec-title">How We Do Agricultural Work</h2>
        </div>
        <div class="row vs-carousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-autoplay="true" data-arrows="true">
            <div class="col-lg-3">
                <div class="process-style1">
                    <div class="process-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/process/process-1-1.png" alt="process-image">
                    </div>
                    <div class="process-content">
                        <h3 class="process-title h5"><a href="service-details.html">Our Plan</a></h3>
                        <p class="process-text">Veritatis eligendi, dignissimo fermentum mus aute pulvinar platea massa rutrum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="process-style1">
                    <div class="process-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/process/process-1-2.png" alt="process-image">
                    </div>
                    <div class="process-content">
                        <h3 class="process-title h5"><a href="service-details.html">Expert Farmer</a></h3>
                        <p class="process-text">Veritatis eligendi, dignissimo fermentum mus aute pulvinar platea massa rutrum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="process-style1">
                    <div class="process-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/process/process-1-3.png" alt="process-image">
                    </div>
                    <div class="process-content">
                        <h3 class="process-title h5"><a href="service-details.html">Quality Pdoduct</a></h3>
                        <p class="process-text">Veritatis eligendi, dignissimo fermentum mus aute pulvinar platea massa rutrum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="process-style1">
                    <div class="process-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/process/process-1-4.png" alt="process-image">
                    </div>
                    <div class="process-content">
                        <h3 class="process-title h5"><a href="service-details.html">We Deliver</a></h3>
                        <p class="process-text">Veritatis eligendi, dignissimo fermentum mus aute pulvinar platea massa rutrum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="process-style1">
                    <div class="process-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/process/process-1-5.png" alt="process-image">
                    </div>
                    <div class="process-content">
                        <h3 class="process-title h5"><a href="service-details.html">More Plan</a></h3>
                        <p class="process-text">Veritatis eligendi, dignissimo fermentum mus aute pulvinar platea massa rutrum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shape-mockup moving z-index d-none d-xl-block" style="left: 0%; top: 5%;"><img src="<?= base_url('themes/farmix/') ?>assets/img/shep/process-shep-1.png" alt="shapes"></div>
</section>
<!--==============================
History Area
============================== -->
<section class="history-layout1 space" data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/bg/history-bg-1.jpg">
    <div class="container">
        <div class="title-area wow fadeInUp wow-animated" data-wow-delay="0.3s">
            <div class="d-flex justify-content-between align-items-center">
                <div class="title-left">
                    <span class="sec-subtitle">Our WOrking PROJECT</span>
                    <h2 class="sec-title">Latest From Our Work</h2>
                </div>
                <div class="title-arraw">
                    <button class="icon-btn slick-prev" data-slick-prev=".project-slider"><i class="fas fa-angle-double-left"></i></button>
                    <button class="icon-btn slick-next" data-slick-next=".project-slider"><i class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
        </div>
        <div class="row vs-carousel project-slider" data-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-autoplay="true" data-arrows="false" data-center-mode="true">
            <div class="col-lg-4">
                <div class="history-style1">
                    <h2 class="history-title">Farm Remodelacion</h2>
                    <p class="history-text">
                        Veritatis eligendi, dignissimo ferm
                        entum mus aute pulvinar platea a
                        massa rutrum.
                    </p>
                    <span class="year">1990</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="history-style1">
                    <h2 class="history-title">Earthy & Delights</h2>
                    <p class="history-text">
                        Veritatis eligendi, dignissimo ferm
                        entum mus aute pulvinar platea a
                        massa rutrum.
                    </p>
                    <span class="year">1989</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="history-style1">
                    <h2 class="history-title">Techniques, & Harvest</h2>
                    <p class="history-text">
                        Veritatis eligendi, dignissimo ferm
                        entum mus aute pulvinar platea a
                        massa rutrum.
                    </p>
                    <span class="year">1980</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="history-style1">
                    <h2 class="history-title">Farm Remodelacion</h2>
                    <p class="history-text">
                        Veritatis eligendi, dignissimo ferm
                        entum mus aute pulvinar platea a
                        massa rutrum.
                    </p>
                    <span class="year">1990</span>
                </div>
            </div>
        </div>
        <div class="border-shep">
            <img src="<?= base_url('themes/farmix/') ?>assets/img/shep/history-border.png" alt="shep">
        </div>
    </div>
</section>
<!--==============================
Counter Area
============================== -->
<section class="counter-layout1 space"  data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/bg/counter-bg.jpg">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-7">
                <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
                    <div class="title-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/title-logo.png" alt="title logo">
                    </div>
                    <h2 class="sec-title">Your Start into the Future of Farming</h2>
                    <span class="sec-subtitle">placing pressure on agriculture to meeting the demands of the future</span>
                    <a href="#" class="vs-btn">Start Discussion!</a>
                </div>
            </div>
        </div>
        <div class="row z-index-common g-5 justify-content-lg-between justify-content-center">
            <div class="col-xl-auto col-lg-4 col-md-6">
                <div class="media-style">
                    <div class="media-inner">
                        <div class="media-icon">
                            <div class="icon">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon1.png" alt="counter-icon">
                            </div>
                        </div>
                        <div class="media-counter">
                            <div class="media-count">
                                <h2 class="media-title counter-number" data-count="3145">00</h2>
                                <span class="media-count_icon"><i class="far fa-plus"></i></span>
                            </div>
                            <p class="media-text">Organic Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-auto col-lg-4 col-md-6">
                <div class="media-style">
                    <div class="media-inner">
                        <div class="media-icon">
                            <div class="icon">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon2.png" alt="counter-icon">
                            </div>
                        </div>
                        <div class="media-counter">
                            <div class="media-count">
                                <h2 class="media-title counter-number" data-count="100">00</h2>
                                <span class="media-count_icon"><i class="far fa-percent"></i></span>
                            </div>
                            <p class="media-text">Organic Guaranteed</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-xl-auto col-lg-4 col-md-6">
                <div class="media-style">
                    <div class="media-inner">
                        <div class="media-icon">
                            <div class="icon">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon3.png" alt="counter-icon">
                            </div>
                        </div>
                        <div class="media-counter">
                            <div class="media-count">
                                <h2 class="media-title counter-number" data-count="160">00</h2>
                                <span class="media-count_icon"><i class="far fa-plus"></i></span>
                            </div>
                            <p class="media-text">Qualified Formers</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-auto col-lg-4 col-md-6">
                <div class="media-style">
                    <div class="media-inner">
                        <div class="media-icon">
                            <div class="icon">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon4.png" alt="counter-icon">
                            </div>
                        </div>
                        <div class="media-counter">
                            <div class="media-count">
                                <h2 class="media-title counter-number" data-count="310">00</h2>
                                <span class="media-count_icon"><i class="far fa-plus"></i></span>
                            </div>
                            <p class="media-text">Agreculture Firm</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="shape-mockup moving z-index d-none d-lg-block" style="right: 8%; bottom: 22%;"><img src="<?= base_url('themes/farmix/') ?>assets/img/shep/about-shep-1.png" alt="shapes"></div>
</section>
<!--==============================
Testmonial Area
============================== -->
<section class="testimonial-layout1 space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="title-area wow fadeInUp wow-animated" data-wow-delay="0.3s">
                    <span class="sec-subtitle">CLIENT TESTIMONIAL</span>
                    <h2 class="sec-title">What Does The Customer Have To Say?</h2>
                </div>
                <div class="vs-carousel" data-arrows="false" data-center-mode="left" data-dots="true" data-autoplay="true" data-slide-show="1">
                    <div class="testi-style1">
                        <div class="auther-inner">
                            <div class="auther-img">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/testimonial/testi-img-1-1.png" alt="testimonial">
                                <div class="testi-icon"><i class="far fa-quote-left"></i></div>
                            </div>
                            <div class="auther-content">
                                <h6 class="name">Thomas Willimes</h6>
                                <span class="designation">Organic Real Farmer</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testi-text">Lorem ipsum dolor sit amet, consec adipiscing elit, sed do 
                            eiusmod tempor incididunt ut labore et dolore magna aliq
                            ua. Ut enim ad minim venia quis nostrud exercitation ullam
                            mpor incididunt co laboris
                        </p>
                    </div>
                    <div class="testi-style1">
                        <div class="auther-inner">
                            <div class="auther-img">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/testimonial/testi-img-1-1.png" alt="testimonial">
                                <div class="testi-icon"><i class="far fa-quote-left"></i></div>
                            </div>
                            <div class="auther-content">
                                <h6 class="name">Thomas Willimes</h6>
                                <span class="designation">Organic Real Farmer</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testi-text">Lorem ipsum dolor sit amet, consec adipiscing elit, sed do 
                            eiusmod tempor incididunt ut labore et dolore magna aliq
                            ua. Ut enim ad minim venia quis nostrud exercitation ullam
                            mpor incididunt co laboris
                        </p>
                    </div>
                    <div class="testi-style1">
                        <div class="auther-inner">
                            <div class="auther-img">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/testimonial/testi-img-1-1.png" alt="testimonial">
                                <div class="testi-icon"><i class="far fa-quote-left"></i></div>
                            </div>
                            <div class="auther-content">
                                <h6 class="name">Thomas Willimes</h6>
                                <span class="designation">Organic Real Farmer</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="testi-text">Lorem ipsum dolor sit amet, consec adipiscing elit, sed do 
                            eiusmod tempor incididunt ut labore et dolore magna aliq
                            ua. Ut enim ad minim venia quis nostrud exercitation ullam
                            mpor incididunt co laboris
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testi-img">
                    <img src="<?= base_url('themes/farmix/') ?>assets//img/testimonial/testi-img.png" alt="testimonial">
                </div>
            </div>
        </div>
    </div>
    <div class="shape-mockup moving z-index-n1 d-none d-xl-block" style="right: 0%; bottom: 5%;"><img src="<?= base_url('themes/farmix/') ?>assets/img/shep/testmonial-shep-1.png" alt="shapes"></div>
</section>
<!--==============================
Brand Area
============================== -->
<div class="brand-layout1 space-bottom">
    <div class="container">
        <div class="row vs-carousel z-index-common" data-arrows="false" data-wow-delay="0.4s" data-slide-show="6"
            data-lg-slide-show="4" data-md-slide-show="4" data-xs-slide-show="2" data-center-mode="true" data-autoplay="true">
                <div class="col-auto">
                    <div class="bran-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/brand/brand-1.png" alt="brand">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bran-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/brand/brand-2.png" alt="brand">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bran-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/brand/brand-3.png" alt="brand">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bran-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/brand/brand-4.png" alt="brand">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bran-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/brand/brand-5.png" alt="brand">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bran-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/brand/brand-6.png" alt="brand">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bran-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/brand/brand-1.png" alt="brand">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bran-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/brand/brand-2.png" alt="brand">
                    </div>
                </div>
            </div>
    </div>
</div>
<?= $this->endSection() ?>