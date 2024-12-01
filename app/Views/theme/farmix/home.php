<?= $this->extend("theme/farmix/index") ?>

<?= $this->section('content') ?>

<?= $this->include("theme/farmix/widget/home-slider") ?>

<!--==============================
Categories Area
============================== -->
<?= $this->include("theme/farmix/widget/home-product-category")  ?>

<!--==============================
About Area
============================== -->
<section class="about-layout2 space-bottom">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="title-area wow fadeInUp wow-animated" data-wow-delay="0.3s">
                        <span class="sec-subtitle">Welcome to Farmix</span>
                        <h2 class="sec-title">Agriculture & Organic Product Farm</h2>
                    </div>
                    <p class="about-text">Lorem ipsum dolor sit amet, porro quisquam est, qui dolorem ipsu
                        quia dolor sit amet, consectetur, adipisci velit.
                    </p>
                    <div class="progress-box">
                        <h3 class="progress-box__title">Organic Solutions</h3>
                        <span class="progress-box__number">83%</span>
                        <div class="progress-box__progress">
                            <div class="progress-box__bar" role="progressbar" style="width: 83%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="progress-box">
                    <h3 class="progress-box__title">Quality Agriculture</h3>
                    <span class="progress-box__number">90%</span>
                    <div class="progress-box__progress">
                        <div class="progress-box__bar" role="progressbar" style="width: 90%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    </div>
                    <div class="bottom-info">
                        <div class="text-box">
                            <h6 class="nunber">12+</h6>
                            <span class="experience">years of <br> experience</span>
                        </div>
                        <div class="author-signature">
                            <img src="<?= base_url('themes/farmix/') ?>assets/img/about/about-signature.png" alt="about-signature">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-img">
                    <div class="about-logo">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/service/selling-img-1-2.png" alt="white logo 2">
                    </div>
                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/about-2-1.jpg" alt="about img 1 1" class="img1">
                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/about-2-2.jpg" alt="about img 2 2" class="img2">
                    </div>
            </div>
        </div>
        <!-- about-deal -->
            <div class="about-deal">
            <div class="row gy-5 gx-5 align-items-center">
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-xl-4 col-md-4 col-6">
                            <div class="deal-item">
                                <a href="#">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-1-1.png" alt="product">
                                    <p class="deal-title">Cabbage</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-6">
                            <div class="deal-item">
                                <a href="#">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-1-2.png" alt="product">
                                    <p class="deal-title">Apple</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-6">
                            <div class="deal-item">
                                <a href="#">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-1-3.png" alt="product">
                                    <p class="deal-title">Orange</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-6">
                            <div class="deal-item">
                                <a href="#">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-1-4.png" alt="product">
                                    <p class="deal-title">Blueberry</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-6">
                            <div class="deal-item">
                                <a href="#">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-1-5.png" alt="product">
                                    <p class="deal-title">Strawberry</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-6">
                            <div class="deal-item">
                                <a href="#">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-1-6.png" alt="product">
                                    <p class="deal-title">Eggplant</p>
                                </a>
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
                            <div class="dela-img">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/about/deal-offer1.png" alt="offer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</section>
<!--==============================
Product Area
============================== -->

<section class="product-layout1 bg-smoke space">
<?= $this->include("theme/farmix/widget/product-carosle")  ?>
</section>
<!--==============================
Provide Area
============================== -->
<section class="provide-layout1 space" data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/bg/provide-bg-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="provide-style1">
                    <div class="title-area wow fadeInUp wow-animated" data-wow-delay="0.3s">
                        <span class="sec-subtitle">Welcome to Farmix</span>
                        <h2 class="sec-title">What We Provide</h2>
                    </div>
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <div class="provide-item">
                                <div class="provide-icon">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon1.png" alt="provide icon">
                                </div>
                                <div class="provide-content">
                                    <h2 class="title h6"><a href="service.html">Quality Foods</a></h2>
                                    <p class="text">In hac habitasse platea ived ict tibulum rhonc us est.</p>
                                </div>
                            </div>
                            <div class="provide-item">
                                <div class="provide-icon">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon2.png" alt="provide icon">
                                </div>
                                <div class="provide-content">
                                    <h2 class="title h6"><a href="service.html">All organic</a></h2>
                                    <p class="text">In hac habitasse platea ived ict tibulum rhonc us est.</p>
                                </div>
                            </div>
                            <div class="provide-item">
                                <div class="provide-icon">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon3.png" alt="provide icon">
                                </div>
                                <div class="provide-content">
                                    <h2 class="title h6"><a href="service.html">Friendly team</a></h2>
                                    <p class="text">In hac habitasse platea ived ict tibulum rhonc us est.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="provide-item">
                                <div class="provide-icon">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon4.png" alt="provide icon">
                                </div>
                                <div class="provide-content">
                                    <h2 class="title h6"><a href="service.html">Eco friendly</a></h2>
                                    <p class="text">In hac habitasse platea ived ict tibulum rhonc us est.</p>
                                </div>
                            </div>
                            <div class="provide-item">
                                <div class="provide-icon">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon5.png" alt="provide icon">
                                </div>
                                <div class="provide-content">
                                    <h2 class="title h6"><a href="service.html">Fresh Vegetables</a></h2>
                                    <p class="text">In hac habitasse platea ived ict tibulum rhonc us est.</p>
                                </div>
                            </div>
                            <div class="provide-item">
                                <div class="provide-icon">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/counter-icon6.png" alt="provide icon">
                                </div>
                                <div class="provide-content">
                                    <h2 class="title h6"><a href="service.html">Use Green Products</a></h2>
                                    <p class="text">In hac habitasse platea ived ict tibulum rhonc us est.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
Team Area
============================== -->
<section class="team-layout1 space">
    <div class="container">
        <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
            <div class="title-img">
                <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/title-logo.png" alt="title logo">
            </div>
            <span class="sec-subtitle">Meet Our Experts</span>
            <h2 class="sec-title">Qualified Formers</h2>
        </div>
        <div class="row vs-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-autoplay="true" data-arrows="true" data-dots="false" data-center-mode="true">
            <div class="col-lg-4">
                <div class="team-style1">
                    <div class="team-content">
                        <h4 class="team-name">Porla Romin</h4>
                        <span class="team-degi">Head of Farmer</span>
                        <a href="#" class="team-contact">+88 013 00 44 51</a>
                        <div class="social-style1">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="team-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/team/team-1-1.png" alt="team img">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-style1">
                    <div class="team-content">
                        <h4 class="team-name">Moniqa Lind</h4>
                        <span class="team-degi">Head of Farmer</span>
                        <a href="#" class="team-contact">+88 013 00 44 51</a>
                        <div class="social-style1">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="team-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/team/team-1-1.png" alt="team img">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-style1">
                    <div class="team-content">
                        <h4 class="team-name">Porla Romin</h4>
                        <span class="team-degi">Head of Farmer</span>
                        <a href="#" class="team-contact">+88 013 00 44 51</a>
                        <div class="social-style1">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="team-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/team/team-1-1.png" alt="team img">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-style1">
                    <div class="team-content">
                        <h4 class="team-name">Porla Romin</h4>
                        <span class="team-degi">Head of Farmer</span>
                        <a href="#" class="team-contact">+88 013 00 44 51</a>
                        <div class="social-style1">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="team-img">
                        <img src="<?= base_url('themes/farmix/') ?>assets/img/team/team-1-1.png" alt="team img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
Faq Area
============================== -->
<section class="faq-layout1 space-bottom">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6">
                <div class="title-area wow fadeInUp wow-animated" data-wow-delay="0.3s">
                    <span class="sec-subtitle">Any Question Please?</span>
                    <h2 class="sec-title">Common Questions & Answers</h2>
                </div>
                <div class="accordion-style1">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            100% natural and 100% organic food?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            Suspendisse potenti. Maecenas dapibus ac tellus sed pulvinar
                            ulum bib volutpat. Sociis, eget mollis, exercitationem famesSu
                            Suspendisse potenti. Maecenas dapibus ac tellus.
                            </div>
                        </div>
                        </div>
                        <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            What agricultural products are produced?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Suspendisse potenti. Maecenas dapibus ac tellus sed pulvinar
                                ulum bib volutpat. Sociis, eget mollis, exercitationem famesSu
                                Suspendisse potenti. Maecenas dapibus ac tellus.
                            </div>
                        </div>
                        </div>
                        <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            What are the top 5 agriculture products?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Suspendisse potenti. Maecenas dapibus ac tellus sed pulvinar
                                ulum bib volutpat. Sociis, eget mollis, exercitationem famesSu
                                Suspendisse potenti. Maecenas dapibus ac tellus.
                            </div>
                        </div>
                        </div>
                        <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Which agricultural product is most important and why?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Suspendisse potenti. Maecenas dapibus ac tellus sed pulvinar
                                ulum bib volutpat. Sociis, eget mollis, exercitationem famesSu
                                Suspendisse potenti. Maecenas dapibus ac tellus.
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="col-lg-6">
                <div class="faq-img">
                    <div class="faq-img1">
                    <img src="<?= base_url('themes/farmix/') ?>assets/img/faq/faq-1-1.jpg" alt="faq 1">
                    </div>
                    <div class="faq-img2">
                    <img src="<?= base_url('themes/farmix/') ?>assets/img/faq/faq-1-2.jpg" alt="faq 1">
                    </div>
                    <div class="media-box1">
                    <span class="media-info">100%</span>
                    <p class="media-text">clients satisfaction</p>
                    </div>
                </div>
                </div>
        </div>
    </div>
</section>
<!--==============================
Testmonial Area
============================== -->
<section class="testimonial-layout2 space" data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/bg/testi-bg-1.jpg">
    <div class="container">
        <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
            <span class="sec-subtitle">What Does The Customer Have To Say?</span>
            <h2 class="sec-title">Clients Testimonials</h2>
        </div>
        <div class="row justify-content-center ">
            <div class="col-lg-10">
                <div class="vs-carousel" data-arrows="false" data-center-mode="left" data-dots="true" data-autoplay="true" data-slide-show="1">
                    <div class="testi-style2">
                        <p class="testi-text">
                            Lorem ipsum dolor sit amet, consec adipiscing elit, sed do  eiusmod tempor 
                            incididunt ut labore et dolore magna aliq ua. Ut enim ad minim venia quis nostrud 
                            exercitation ullam mpor incididunt co laboris.
                        </p>
                        <div class="auther-inner">
                            <div class="auther-img">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/testimonial/testi-img-1-1.png" alt="testimonial">
                                <div class="testi-icon"><i class="far fa-quote-left"></i></div>
                            </div>
                            <div class="auther-content">
                                <h3 class="name h5">Thomas Willimes</h3>
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
                    </div>
                    <div class="testi-style2">
                        <p class="testi-text">
                            Lorem ipsum dolor sit amet, consec adipiscing elit, sed do  eiusmod tempor 
                            incididunt ut labore et dolore magna aliq ua. Ut enim ad minim venia quis nostrud 
                            exercitation ullam mpor incididunt co laboris.
                        </p>
                        <div class="auther-inner">
                            <div class="auther-img">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/testimonial/testi-img-1-1.png" alt="testimonial">
                                <div class="testi-icon"><i class="far fa-quote-left"></i></div>
                            </div>
                            <div class="auther-content">
                                <h3 class="name h5">Thomas Willimes</h3>
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
                    </div>
                    <div class="testi-style2">
                        <p class="testi-text">
                            Lorem ipsum dolor sit amet, consec adipiscing elit, sed do  eiusmod tempor 
                            incididunt ut labore et dolore magna aliq ua. Ut enim ad minim venia quis nostrud 
                            exercitation ullam mpor incididunt co laboris.
                        </p>
                        <div class="auther-inner">
                            <div class="auther-img">
                                <img src="<?= base_url('themes/farmix/') ?>assets/img/testimonial/testi-img-1-1.png" alt="testimonial">
                                <div class="testi-icon"><i class="far fa-quote-left"></i></div>
                            </div>
                            <div class="auther-content">
                                <h3 class="name h5">Thomas Willimes</h3>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
Blog Area
============================== -->
<section class="blog-layout1 space">
    <div class="container">
        <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
            <div class="title-img">
                <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/title-logo.png" alt="title logo">
            </div>
            <span class="sec-subtitle">Blog & News</span>
            <h2 class="sec-title">Recent Articles</h2>
        </div>
        <div class="row vs-carousel" data-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-autoplay="true" data-arrows="true">
            <div class="col-lg-4">
                <div class="vs-blog blog-single">
                    <div class="blog-img">
                        <a href="blog-details.html"><img src="<?= base_url('themes/farmix/') ?>assets/img/blog/blog-img-1-1.jpg" alt="Blog Image"></a>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <a href="#"><i class="fal fa-tag"></i>Fresh Vegetables</a>
                        </div>
                        <h2 class="blog-title"><a href="blog-details.html">Harvest London Publishes Its First Annua</a></h2>
                        <div class="blog-inner-author">
                            <img src="<?= base_url('themes/farmix/') ?>assets/img/blog/blog-auth-1-1.png" alt="blog author">
                            <div class="text">
                                by <a href="blog.html">Jakki James</a>
                                <a href="blog.html" class="blog-date">Dec 13, 2024</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="vs-blog blog-single">
                    <div class="blog-img">
                        <a href="blog-details.html"><img src="<?= base_url('themes/farmix/') ?>assets/img/blog/blog-img-1-2.jpg" alt="Blog Image"></a>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <a href="#"><i class="fal fa-tag"></i>Fresh Vegetables</a>
                        </div>
                        <h2 class="blog-title"><a href="blog-details.html">Harvest London Releases Their Initial Annual</a></h2>
                        <div class="blog-inner-author">
                            <img src="<?= base_url('themes/farmix/') ?>assets/img/blog/blog-auth-1-1.png" alt="blog author">
                            <div class="text">
                                by <a href="blog.html">Jakki James</a>
                                <a href="blog.html" class="blog-date">Dec 13, 2024</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="vs-blog blog-single">
                    <div class="blog-img">
                        <a href="blog-details.html"><img src="<?= base_url('themes/farmix/') ?>assets/img/blog/blog-img-1-3.jpg" alt="Blog Image"></a>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <a href="#"><i class="fal fa-tag"></i>Fresh Vegetables</a>
                        </div>
                        <h2 class="blog-title"><a href="blog-details.html">First Annual Report by Harvest is Published</a></h2>
                        <div class="blog-inner-author">
                            <img src="<?= base_url('themes/farmix/') ?>assets/img/blog/blog-auth-1-1.png" alt="blog author">
                            <div class="text">
                                by <a href="blog.html">Jakki James</a>
                                <a href="blog.html" class="blog-date">Dec 13, 2024</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="vs-blog blog-single">
                    <div class="blog-img">
                        <a href="blog-details.html"><img src="<?= base_url('themes/farmix/') ?>assets/img/blog/blog-img-1-4.jpg" alt="Blog Image"></a>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <a href="#"><i class="fal fa-tag"></i>Fresh Vegetables</a>
                        </div>
                        <h2 class="blog-title"><a href="blog-details.html">Harvest Issues London Its  Annual Report</a></h2>
                        <div class="blog-inner-author">
                            <img src="<?= base_url('themes/farmix/') ?>assets/img/blog/blog-auth-1-1.png" alt="blog author">
                            <div class="text">
                                by <a href="blog.html">Jakki James</a>
                                <a href="blog.html" class="blog-date">Dec 13, 2024</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog-btn">
            <a href="blog.html" class="vs-btn">View All News</a>
        </div>
    </div>
</section>
<!--==============================
Brand Area
============================== -->
<div class="brand-layout1 space-bottom">
    <div class="container">
        <div class="row vs-carousel z-index-common" data-arrows="false" data-wow-delay="0.4s" data-slide-show="6"
            data-lg-slide-show="5" data-md-slide-show="4" data-xs-slide-show="2" data-center-mode="true" data-autoplay="true">
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