<?= $this->extend("theme/farmix/index") ?>

<?= $this->section('content') ?>
<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?= base_url('themes/farmix/') ?>assets/img/breadcumb/breadcumb-bg.png">
    <div class="container z-index-common">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Contact</h1>
        </div>
        <div class="breadcumb-menu-wrap">
            <ul class="breadcumb-menu">
                <li><a href="index.html">Home</a></li>
                <li>Contact</li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
Contact Area
============================== -->
<section class="contact-layout1 space">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="title-area wow fadeInUp wow-animated" data-wow-delay="0.3s">
                    <span class="sec-subtitle">CONTACT US</span>
                    <h2 class="sec-title">We're Here to Help You. Get in Touch with Our Team!</h2>
                </div>
                <div class="vs-comment-form">
                    <div id="respond" class="comment-respond">
                        <div class="form-title">
                            <p class="form-text">Please fill out the form below and one of our recruitment specialists will back in touch shortly.</p>
                        </div>
                        <form action="mail.php" method="post" class="form-style3 ajax-contact">
                            <div class="row">
                                <div class="col-12  form-group">
                                    <textarea name="message" class="form-control" placeholder="Message" required=""></textarea>
                                    </div>
                                <div class="col-md-6 form-group">
                                <input name="fname" type="text" class="form-control" placeholder="Name" required="">
                                </div>
                                <div class="col-6 form-group">
                                <input name="email" type="email" class="form-control" placeholder="Email Address" required="">
                                </div>
                                <div class="col-12 ">
                                <div class="custom-checkbox notice">
                                    <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
                                    <label for="wp-comment-cookies-consent"> Save my name, email, and website in this browser for the next time I comment.</label>
                                </div>
                            </div>
                                <div class="col-12 form-group">
                                <button class="vs-btn" type="submit">
                                    Send Message
                                </button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messages mb-0 mt-3"></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="contact-left">
                    <div class="auther-inner">
                        <div class="auther-img">
                            <img src="<?= base_url('themes/farmix/') ?>assets/img/about/about-author.png" alt="about">
                        </div>
                        <div class="auther-content">
                            <h6 class="name">Thomas Walkar</h6>
                            <span class="designation">founde - CEO</span>
                            <img src="<?= base_url('themes/farmix/') ?>assets/img/about/contact-signature.png" alt="contact">
                        </div>
                    </div>
                    <div class="team-media">
                        <h2 class="contact-title">Professional Skills</h2>
                        <div class="media-style1">
                            <div class="media-icon"><img src="<?= base_url('themes/farmix/') ?>assets/img/icon/icon-1-1.png" alt="icon"></div>
                            <div class="media-body">
                                <h3 class="media-title">Phone No:</h3>
                                <p class="media-info"><a href="tel:+88013004451">+88 013 00 44 51</a> <br> Mon - Sat: 09.00 to 06.00</p>
                            </div>
                        </div>
                        <div class="media-style1">
                            <div class="media-icon"><img src="<?= base_url('themes/farmix/') ?>assets/img/icon/icon-1-2.png" alt="icon"></div>
                            <div class="media-body">
                                <h3 class="media-title">Email Address:</h3>
                                <p class="media-info"><a href="mailto:example@domain.com">example@domain.com</a> <br> <a href="mailto:officename@example.com">officename@example.com</a></p>
                            </div>
                        </div>
                        <div class="media-style1">
                            <div class="media-icon"><img src="<?= base_url('themes/farmix/') ?>assets/img/icon/icon-1-3.png" alt="icon"></div>
                            <div class="media-body">
                                <h3 class="media-title">Locatoin:</h3>
                                <p class="media-info">5919 Trussville Crossings Pkwy, Birmingham, United Kingdom</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29518.147468872132!2d90.35144910000001!3d22.362370900000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1725012606149!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
<!--==============================
Faq Area
============================== -->
<section class="faq-layout1 space-bottom">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-12">
                <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
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
        </div>
    </div>
</section>
<?= $this->endSection() ?>