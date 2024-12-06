<?php
$testimonials = get_testimonials_list();
?>
<?php
if(!empty($testimonials)):
foreach($testimonials as $testimonial):
?>
<div class="testi-style2">
    <p class="testi-text">
        <?= $testimonial['testimonial_text'] ?>
    </p>
    <div class="auther-inner">
        <div class="auther-img">
            <img src="<?= base_url('uploads/testimonials/') ?><?= $testimonial['client_image'] ?>" alt="testimonial">
            <div class="testi-icon"><i class="far fa-quote-left"></i></div>
        </div>
        <div class="auther-content">
            <h3 class="name h5"><?= $testimonial['client_name'] ?></h3>
            <span class="designation">Client</span>
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
<?php
endforeach;
endif;
?>