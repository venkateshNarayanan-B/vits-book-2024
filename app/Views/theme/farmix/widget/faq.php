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
                        <?php
                         $faqs = get_faq_list();
                        ?>
                        <?php
                        if(!empty($faqs)):
                            foreach($faqs as $faq):
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button <?= isset($faq['show']) ? "":"collapsed" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $faq['id'] ?>" aria-expanded="<?= isset($faq['show']) ? "true":"false" ?>" aria-controls="collapseOne">
                                <?= $faq['question'] ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $faq['id'] ?>" class="accordion-collapse collapse <?= isset($faq['show']) ? "show":"" ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <?= $faq['answer'] ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        endforeach;
                        endif;
                        ?>
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