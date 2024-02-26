<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- SEO Meta description -->
    <meta name="description" content="Login Area">
    <meta name="author" content="redhorivai">
    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content=""/> <!-- website name -->
    <meta property="og:site" content=""/> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content=""/> <!-- description shown in the actual shared post -->
    <meta property="og:image" content=""/> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""/> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article"/>
    <!--title-->
    <title>Login Area</title>
    <link href="<?= base_url(); ?>/assets-admin/panel/images/logo/Logo-UMPalembang-2019-Mini.ico" rel="shortcut icon">
    <!--google fonts-->
    <link href="../fonts.googleapis.com/csse945.css?family=Montserrat:400,500,600,700%7COpen+Sans&amp;display=swap"
          rel="stylesheet">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/login/css/bootstrap.min.css">
    <!--Themify icon css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/login/css/themify-icons.css">
    <!--custom css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/login/css/style.css">
    <!--responsive css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/login/css/responsive.css">
</head>
<body>
<!-- PRELOADER -->
<div id="preloader">
    <div class="loader1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END PRELOADER -->

<!--body content wrap start-->
<div class="main">
    <!--hero section start-->
    <section class="hero-section gradient-overlay full-screen">
        <div class="container">
            <div class="row align-items-center justify-content-between pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                <div class="col-md-4">
                    <div class="hero-content-left text-white">
                        <h1 class="text-white mb-0">Panel SIM KKN</h1>
                        <p class="lead">UNIV. MUHAMMADYAH PALEMBANG </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card login-signup-card shadow-lg mb-0 ml-3 mr-3">
                        <div class="card-body px-md-5 py-4">
                            <div class="mb-5">
                                <h5 class="h3">Login</h5>
                                <!-- <p class="text-muted mb-0">Sign in to your account to continue.</p> -->
                            </div>
                            <!-- LOGIN FORM -->
                            <form id="login_form" class="login-signup-form">
							<?= csrf_field(); ?>	
                                <div class="form-group">
                                    <label class="pb-1">Username</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-icon">
                                            <span class="ti-user color-primary"></span>
                                        </div>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Nim/username" style="text-transform:lowercase;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="pb-1">Kata Sandi</label>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <div class="input-icon">
                                            <span class="ti-lock color-primary"></span>
                                        </div>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block solid-btn border-radius mt-4 mb-3">
                                    Masuk
                                </button>
							</form>
							<!-- END LOGIN FORM -->
                        </div>
                        <div class="card-footer text-center bg-transparent border-top px-md-5">
							<small>Belum memiliki akun?<a href="<?= base_url()?>/daftar" style="color:#4A954A;"> Daftar Akun</a></small>
						</div>
                    </div>
				</div>
				<div class="col-md-4"></div>
            </div>
        </div>
        <div class="shape-bottom">
            <img src="<?= base_url(); ?>/assets-admin/login/images/animated_ump.svg" class="bottom-shape img-fluid full-screen">
        </div>
    </section>
    <!--hero section end-->
</div>

<!--body content wrap end-->
<?php
    if (!empty(session()->getFlashdata('sukses'))) {
		echo '<div class="flash_msg" data-successful="' . session()->getFlashdata('sukses') . '"></div>';
	} else if (!empty(session()->getFlashdata('gagal'))) {
		echo '<div class="flash_msg" data-failed="' . session()->getFlashdata('gagal') . '"></div>';
	} else if (!empty(session()->getFlashdata('error'))) {
		echo '<div class="flash_msg" data-goofy="' . session()->getFlashdata('error') . '"></div>';
	}
?>
<!--jQuery-->
<script src="<?= base_url(); ?>/assets-admin/login/js/jquery-3.4.1.min.js"></script>
<!--Popper js-->
<script src="<?= base_url(); ?>/assets-admin/login/js/popper.min.js"></script>
<!--Bootstrap js-->
<script src="<?= base_url(); ?>/assets-admin/login/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/login/js/sweetalert2.all.min.js"></script>
<!--custom js-->
<script src="<?= base_url(); ?>/assets-admin/login/js/validasi-login.js"></script>
<script src="<?= base_url(); ?>/assets-admin/login/js/scripts.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        const Toast = Swal.mixin({
		    toast             : true,
			position          : "top",
			showConfirmButton : false,
			timer             : 3000,
        });             
        $('#login_form').submit(function(e) {
        e.preventDefault();
            if ($('#username').val() == "") {
                Toast.fire({
				    icon  : "warning",
					title : "Silahkan masukkan username Anda",
                });
				$("#username").focus();
            } else if ($('#password').val() == "") {
				Toast.fire({
				    icon  : "warning",
					title : "Silahkan masukkan kata sandi Anda",
				});
				$("#password").focus();
            } else {
                $.ajax({
					type     : "POST",
					url      : "<?= base_url('Backend/login/get_login'); ?>",
					data     : $(this).serialize(),
					dataType : "JSON",
					success: function(response) {
					    if (response.sukses) {
						    setTimeout(function() {
							Toast.fire({
							    icon  : "success",
								title : response.sukses,
							});
							}, 10);
							window.setTimeout(function() {
							window.location.replace("<?= base_url('/panel/dashboard'); ?>");
							}, 2000);
						} else {
							Toast.fire({
								icon  : "error",
								title : response.gagal,
							});
						}
					}
				});
				return false;
			}
        });
    });
</script>
</body>
</html>