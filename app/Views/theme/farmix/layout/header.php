

<header class="vs-header header-layout1">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <div class="header-links">
                        <ul>
                            <li><i class="far fa-map-marker-alt"></i>California, TX 70240</li>
                            <li><i class="far fa-envelope"></i><a href="mailto:info@example.com">info@example.com</a></li>
                            <li><i class="far fa-phone-alt"></i><a href="tel:+4733378901">+473 3378 901</a></li>
                            <li><i class="far fa-clock"></i>Mon - Sat: 09.00 to 06.00</li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="social-style1">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <div class="sticky-active">
            <div class="menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                <a href="index.html">
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/logo.png" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <nav class="main-menu menu-style1 d-none d-lg-block">
                                <?= renderMenu($topNav); ?>
                            </nav>
                        </div>
                        <div class="col-auto d-lg-none">
                            <button class="vs-menu-toggle d-inline-block">
                                <i class="fal fa-bars"></i>                                           
                            </button>
                        </div>
                        <div class="col-auto d-xl-block d-none">
                            <div class="header-icons">
                                <a href="#" class="icon-btn"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>