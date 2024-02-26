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
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />
    <!--title-->
    <title>Daftar Area</title>
    <link href="<?= base_url(); ?>/assets-admin/panel/images/logo/Logo-UMPalembang-2019-Mini.ico" rel="shortcut icon">
    <!--google fonts-->
    <!-- <link href="../fonts.googleapis.com/csse945.css?family=Montserrat:400,500,600,700%7COpen+Sans&amp;display=swap" rel="stylesheet"> -->
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
    <!-- END PRELOADER

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
                    <div class="col-md-8">
                        <div class="card login-signup-card shadow-lg mb-0 ml-3 mr-3">
                            <div class="card-body px-md-5 py-4">
                                <div class="mb-5">
                                    <h5 class="h3">Daftar</h5>
                                    <!-- <p class="text-muted mb-0">Sign in to your account to continue.</p> -->
                                </div>
                                <!-- LOGIN FORM -->
                                <form id="login_form" class="login-signup-form" action="<?= site_url('Daftar/Upload'); ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">Nama Lengkap <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-user color-primary"></span>
                                                    </div>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap" style="text-transform:capitalize;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">No Induk Mahasiswa <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-user color-primary"></span>
                                                    </div>
                                                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan nim" style="text-transform:lowercase;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">Jenis Kelas <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-user color-primary"></span>
                                                    </div>
                                                    <select class='form-control select2' id='klasifikasi' name='klasifikasi' data-placeholder='-- Pilih Jenis Klasifikasi --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                                                        <option value=''></option>
                                                        <option value='reguler'>Reguler</option>
                                                        <option value='nasional'>Nasional</option>
                                                        <option value='internasional'>Internasional</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">Jenis Kelamin <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-user color-primary"></span>
                                                    </div>
                                                    <select class='form-control select2' id='gender' name='gender' data-placeholder='-- Pilih Aplikasi --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                                                        <option value=''></option>
                                                        <option value='L'>Laki-laki</option>
                                                        <option value='P'>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">Email <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-email color-primary"></span>
                                                    </div>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" style="text-transform:lowercase;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">No Telepon <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-mobile color-primary"></span>
                                                    </div>
                                                    <input type="number" id="phone" name="phone" class="form-control" placeholder="Masukkan telepon" style="text-transform:lowercase;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">Tempat Lahir <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-layout-cta-center color-primary"></span>
                                                    </div>
                                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">Tanggal Lahir <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-comments color-primary"></span>
                                                    </div>
                                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Masukkan tanggal lahir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">Status Pengguna <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-icon">
                                                        <span class="ti-user color-primary"></span>
                                                    </div>
                                                    <select class='form-control select2' id='level' name='level' data-placeholder='-- Pilih status Pengguna --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                                                        <option value=''></option>
                                                        <option value='Admin'>Dosen</option>
                                                        <option value='User'>Mahasiswa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="pb-1">Alamat <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <textarea rows='3' id='address' name='address' class='form-control'></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label class="pb-1">Dokumen Pendaftaran (krs,transkip,surat izin,bpp) <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                                <input type="file" id="path_dok" name="path_dok">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-block solid-btn border-radius mt-4 mb-3"">
                                        Daftar
                                    </button>
                                </form>
                                <!-- END LOGIN FORM -->
                            </div>
                            <div class="card-footer text-center bg-transparent border-top px-md-5">
                                <small>Sudah memiliki akun?<a href="<?= base_url() ?>/panel" style="color:#21b42d;"> Login</a></small>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="shape-bottom">
                    <img src="<?= base_url(); ?>/assets-admin/login/images/hero-shape-bottom.svg" class="bottom-shape img-fluid">
                </div>
        </section>
        <!--hero section end-->
    </div>

    <!-- <script>
      $(document).ready(function() {

        $(".btn-block").click( function() {

            $.ajax({

              url: "<?php echo base_url() ?>/panel",
              type: "GET",

              success:function(response){
                

                  Swal.fire({
                    type: 'success',
                    title: 'Test Whatsapp API Berhasil!',
                    showCancelButton: false,
                    showConfirmButton: true
                  })
                  .then (function() {
                    window.location.href = "<?php echo base_url() ?>/daftar";
                  });                  
              },

              error:function(response){

                  Swal.fire({
                    type: 'error',
                    title: 'Test Whatsapp Gagal!',
                    text: 'Silahkan Cek URL!'
                  });

              }

            });

        }); 

      });
    </script> -->
    

    <!--jQuery-->
    <script src="<?= base_url(); ?>/assets-admin/login/js/jquery-3.4.1.min.js"></script>
    <!--Popper js-->
    <script src="<?= base_url(); ?>/assets-admin/login/js/popper.min.js"></script>
    <!--Bootstrap js-->
    <script src="<?= base_url(); ?>/assets-admin/login/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets-admin/login/js/sweetalert2.all.min.js"></script>
    <!-- custom js -->
    <script src="<?= base_url(); ?>/assets-admin/login/js/validasi-login.js"></script>
    <script src="<?= base_url(); ?>/assets-admin/login/js/scripts.js"></script>
</body>

</html>