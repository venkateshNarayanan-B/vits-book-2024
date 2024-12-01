<?= $this->extend("theme/farmix/index") ?>

<?= $this->section('content') ?>

<?php
$product_detail = productDetails(6);

?>
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
                    <?php if(!empty($product_detail['images'])): ?>
                        <?php foreach($product_detail['images'] as $image): ?>
                            <div>
                                <div class="thumb"><img src="<?= $image['image_path'] ?>" alt="<?= $product_detail['title'] ?>"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-10 col-md-9">
                <div class="product-big-img vs-carousel" data-slide-show="1" data-fade="true" data-asnavfor=".product-thumb-slide">
                <?php if(!empty($product_detail['images'])): ?>
                    <?php foreach($product_detail['images'] as $image): ?>
                    <div class="img"><img src="<?= $image['image_path'] ?>" alt="<?= $product_detail['title'] ?>"></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="product-about">
            
            <h2 class="product-title"><?= $product_detail['title'] ?></h2>
            <div class="actions">
                
                <p class="product-price">&#8377;<?= $product_detail['price'] ?> <del>&#8377;23.85</del></p>
                <p>For Shipping Terms Applied</p>
                <a href="#" class="vs-btn" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="far fa-inr"></i>Get Best Price</a>
                <a href="#" class="icon-btn"><i class="far fa-heart"></i></a><br /><br />
                <a href="#" class="vs-btn" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="far fa-envelope"></i>Send Enquiry</a>
            </div>
            <div class="product_meta">
                <span class="sku_wrapper">
                <p>Business Type:</p> <span class="sku">Exporter, Supplier, Trader</span>
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
                <button class="nav-link" id="pills-information-tab" data-bs-toggle="pill" data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information" aria-selected="false">Product Specificatons</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Are You Interested</button>
            </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="description">
                <h3 class="description-title h5">Description</h3>
                <p class="text" style="text-align: justify;"><?= $product_detail['description'] ?></p>
                    
                
                
            </div>
            </div>
            <div class="tab-pane fade" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
            <div class="product-information">
                <h3 class="description-title h5">Additional Information</h3>
                <table class="product-information__item table">
                    <tbody>
                        <?php if(!empty($product_detail['specifications'])): ?>
                            <?php foreach($product_detail['specifications'] as $specifications): ?>
                        <tr>
                        <th class="product-information__name" scope="row"><?= $specifications['specification_key'] ?></th>
                        <td><?= $specifications['specification_value'] ?></td>
                        </tr>
                        <tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <h3 class="description-title h5">"Looking For A Grade <?= $product_detail['name'] ?>"</h3>
            <div class="row woocommerce-reviews">
                <div class="col-lg-12">
                    <div class="vs-comment-form review-form">
                        <div id="respond" class="comment-respond">
                            <div class="form-title mb-4">
                                <h3 class="description-title h5">Post Your Requirement</h3>
                            </div>
                            <div class="row">
                                <form action="<?= base_url('submit-enquiry') ?>" method="post">
                                <input type="hidden" name="product_id" value="<?= $product_detail['id'] ?>">
                                <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Complete Name" required>
                                </div>
                                <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                                </div>
                                <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Mobile Number" required>
                                </div>
                                <div class="col-12 form-group">
                                <textarea class="form-control" name="message" id="message" placeholder="Requirement Details" required></textarea>
                                </div>
                                <div class="col-12 form-group mb-0">
                                <button class="vs-btn"> <span class="vs-btn__bar"></span>Submit</button>
                                </div>
                                </form>
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

<!-- Bootstrap Modal -->
<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enquiryModalLabel">Submit Your Enquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form action="<?= base_url('submit-enquiry') ?>" method="post">
                    <input type="hidden" name="product_id" value="<?= $product_detail['id'] ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Complete Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your mobile number" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Requirement Details</label>
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="Enter your requirement" required></textarea>
                    </div>
                    <button type="submit" class="vs-btn w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const enquiryModal = document.getElementById('enquiryModal');
        enquiryModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget; // Button that triggered the modal
            const productName = button.getAttribute('data-product-name'); // Extract product name
            const modalTitle = enquiryModal.querySelector('.modal-title');

            // Update modal title with the product name
            if (productName) {
                modalTitle.textContent = `Submit Your Enquiry for ${productName}`;
            }
        });
    });

</script>
<?= $this->endSection() ?>