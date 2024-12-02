<section class="categorie-layout1 space">
    <div class="container">
        <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
            <div class="title-img">
                <img src="<?= base_url('themes/farmix/') ?>assets/img/icon/title-logo.png" alt="title logo">
            </div>
            <span class="sec-subtitle">Our Categories</span>
            <h2 class="sec-title">Organic Product Categories</h2>
        </div>
        <div class="row  justify-content-center vs-carousel" data-slide-show="5" data-lg-slide-show="4" data-md-slide-show="3" data-center-mode="true" data-autoplay="true" data-dots="true" data-arrows="false">
            <?php
            $categories = get_categoried_list();
            if(!empty($categories)):
                foreach($categories as $category):
            ?>
            <div class="col-auto">
                <div class="categorie-style1">
                    <div class="categorie-img">
                        <img src="<?= base_url('uploads/categories/'.$category['image']) ?>" alt="categorie">
                    </div>
                    <div class="categorie-content">
                        <h3 class="categorie-title h5"><a href="<?= base_url('products/category/'.$category['id']) ?>"><?= $category['name'] ?></a></h3>
                    </div>
                </div>
            </div>
            
            <?php 
            endforeach;
            endif; 
            ?>
        </div>
    </div>
</section>