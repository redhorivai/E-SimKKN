<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM KKN Universitas Muhammadyah Palembang</title>

    <!-- css libary -->
    <link href="<?= base_url(); ?>/assets-front/images/Logo-UMPalembang-2019-Mini.ico" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/styles/bootstrap4/bootstrap.min.css">
    <link href="<?= base_url(); ?>/assets-front/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/styles/responsive.css">

    <!-- javascript library -->
    <script src="<?= base_url(); ?>/assets-front/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>/assets-front/styles/bootstrap4/popper.js"></script>
    <script src="<?= base_url(); ?>/assets-front/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets-front/plugins/greensock/TweenMax.min.js"></script>
    <script src="<?= base_url(); ?>/assets-front/plugins/greensock/TimelineMax.min.js"></script>
    <script src="<?= base_url(); ?>/assets-front/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="<?= base_url(); ?>/assets-front/plugins/greensock/animation.gsap.min.js"></script>
    <script src="<?= base_url(); ?>/assets-front/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="<?= base_url(); ?>/assets-front/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>/assets-front/plugins/easing/easing.js"></script>
    <script src="<?= base_url(); ?>/assets-front/plugins/parallax-js-master/parallax.min.js"></script>
    <script src="<?= base_url(); ?>/assets-front/js/custom.js"></script>

</head>
<body>
   
    <div class="super_container">
        <!-- HEADER & MENU -->
    <?= $this->include('front/layout/header'); ?>
    
    <!-- START MAIN CONTENT -->
    <?= $this->renderSection('content'); ?>
    <!-- END MAIN CONTENT -->
    
    <!-- FOOTER -->
    <?= $this->include('front/layout/footer'); ?>

    </div>
    
</body>
</html>