<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="author" content="venkatesh narayanan">
    <meta name="title" content="<?= $metaTitle ?>">
    <meta name="description" content="<?= $metaDescription ?>">
    <meta name="keywords" content="<?= $metaKeyword ?>">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="<?= base_url('themes/farmix/') ?>assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url('themes/farmix/') ?>assets/img/favicon.ico" type="image/x-icon">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=DM+Sans:wght@400&display=swap" rel="stylesheet">


    <!--==============================
	    All CSS File
	============================== -->
    <?= $this->include("theme/farmix/layout/styles") ?>
    <?= $this->renderSection("styles") ?>
    

</head>

<body>


    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->



    <!--********************************
   		Code Start From Here 
	******************************** -->




    <!--==============================
    Mobile Menu
    ============================== -->
    <?= $this->include("theme/farmix/layout/mobile-menu") ?>
    
    <!--==============================
    Cart Side bar
    ============================== -->
    <?php
    // $this->include("theme/farmix/layout/cart-sidebar") 
    ?>
    
    <!--==============================
    Header Area
    ==============================-->
    <?= $this->include("theme/farmix/layout/header") ?>
    <?= $this->renderSection('content'); ?>
    
    <!--==============================
			Footer Area
	==============================-->
     
    <?= $this->include("theme/farmix/layout/footer") ?>
    <!-- Scroll To Top -->
    <a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>

    <!--********************************
			Code End  Here 
	******************************** -->

    <!--==============================
        All Js File
    ============================== -->
    <?= $this->include("theme/farmix/layout/scripts") ?>
    <?= $this->renderSection("scripts") ?>
    


</body>

</html>