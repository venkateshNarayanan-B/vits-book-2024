<!--==============================
Hero Area
============================== -->
<div class="hero-layout2">
    <div class="container position-relative">
        <div class="vs-carousel" data-dots="true" data-slide-show="1" data-autoplay="true" data-fade="true">
            <?php foreach($slides as $slide): ?>
            <div class="hero-slide">
                <div class="container">
                    <div class="row g-5 align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="hero-content">
                                <h1 class="hero-title"><?= $slide['title'] ?></h1>
                                <p class="hero-text"><?= $slide['description'] ?></p>
                                <div class="hero-bottom">
                                    <a href="<?= $slide['button_link'] ?>" class="vs-btn"><?= $slide['button_text'] ?></a>
                                    <img src="<?= base_url('themes/farmix/') ?>assets/img/bg/hero-logo-1.png" alt="brand-logo">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-img">
                                <div class="batch"><img src="<?= base_url('themes/farmix/') ?>assets/img/hero/hero-batch.png" alt="batch"></div>
                                <img src="<?= base_url('uploads/slides/'.esc($slide['image'])) ?>" alt="hero-slider">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="shape-mockup moving z-index d-none d-xl-block" style="left: 0%; bottom: 10%;"><img src="<?= base_url('themes/farmix/') ?>assets/img/shep/hero-shep-1.png" alt="shapes"></div>
</div>