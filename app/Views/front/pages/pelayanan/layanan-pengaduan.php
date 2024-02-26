<?= $this->extend('front/layout/main_layout') ?>
<?= $this->section('content'); ?>
<!-- MAIN CONTENT -->
<div class="main-content">
  <!-- SECTION: BREADCRUMB -->
  <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-color="#CCC">
    <div class="container pt-30 pb-30">
      <div class="section-content">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="title"><?= $title; ?></h2>
            <ol class="breadcrumb text-center text-black mt-10">
              <li><a href="<?= base_url('/'); ?>">Beranda</a></li>
              <li><a href="<?= base_url('/pelayanan'); ?>">Pelayanan</a></li>
              <li class="active text-theme-colored"><?= $title; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTENT -->
  <section>
    <div class="container">
      <div class="section-content">
        <div class="row">
          <div class="col-md-12">
            <div class="service-content ml-20 ml-sm-0">
              <h3 class="title text-center mt-0 mb-0">Layanan Aspirasi dan Pengaduan Online Rakyat</h3>
              <h5 class="text-center mt-0 mb-0">Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang</h5>
              <p class="text-center mt-10 mb-0" style="color: #666;">Klik disini</p>
              <p class="text-center mt-0" style="color: #666;line-height:1;"><i class="fa fa-angle-double-down"></i></p>
              <div class="item text-center">
                <a href="https://www.lapor.go.id/" target="_blank">
                  <img src="<?= base_url(); ?>/assets-front/images/logo_lapor.png">
                </a>
              </div>
            </div>
          </div>
          
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <h3 class="title text-center mt-50 mb-30">Layanan Pengaduan RSUD Palembang BARI</h3>
            <div class="item">

              <form id="form_lapor" name="form_lapor" class="forms">

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nama <small>*</small></label>
                      <input name="nama" id="nama" class="form-control" type="text" placeholder="Masukkan Nama" required="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email <small>*</small></label>
                      <input name="email" id="email" class="form-control required email" type="email" placeholder="Masukkan Alamat Email">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Telepon <small>*</small></label>
                      <input name="telepon" id="telepon" class="form-control" type="text" placeholder="Masukkan No. Telepon">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Pesan <small>*</small></label>
                      <textarea name="pesan" id="pesan" class="form-control required" rows="5" placeholder="Tulis Pesan .."></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-group text-center">
                  <button type="button" class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" onclick="_kirim_pesan()">Kirim Pesan</button>
                  <button type="reset" class="btn btn-flat btn-light text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px">Reset</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END CONTENT -->
</div>
<script type="text/javascript">
    function _kirim_pesan() {
        var nama    = $("#nama").val();
        var email   = $("#email").val();
        var telepon = $("#telepon").val();
        var pesan   = $("#pesan").val();

        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        ajaxData.append('nama', nama);
        ajaxData.append('email', email);
        ajaxData.append('telepon', telepon);
        ajaxData.append('pesan', pesan);

        if (nama == "") {
            $('#nama').focus();
            $('#nama').addClass('is-invalid');
        } else {
            $('#nama').removeClass('is-invalid');
        }
        if (email == "") {
            $('#email').addClass('is-invalid');
        } else {
            $('#email').removeClass('is-invalid');
        }
        if (telepon == "") {
            $('#telepon').addClass('is-invalid');
        } else {
            $('#telepon').removeClass('is-invalid');
        }
        if (pesan == "") {
            $('#pesan').addClass('is-invalid');
        } else {
            $('#pesan').removeClass('is-invalid');
        }

        if (nama && email && telepon && pesan) {
          $.ajax({
              url: "<?= site_url('Pelayanan/insert_data'); ?>",
              type: "POST",
              data: ajaxData,
              contentType: false,
              cache: false,
              processData: false,
              dataType: "json",
              success: function(response) {
                  if (response == "Sukses") {
                      Toast.fire({
                          icon: "success",
                          title: "Pesan telah di kirim, terima kasih."
                      });
                      $('#form_lapor')[0].reset();
                  } else {
                      $("#nama").focus();
                      Swal.fire({
                          title: 'Pemberitahuan',
                          html: response,
                          icon: 'warning',
                          showConfirmButton: true,
                      });
                  }
              },
              error: function() {
                  Toast.fire({
                      icon: "error",
                      title: "Error !, Silahkan coba beberapa saat lagi."
                  });
              }
          });
        }
    }
</script>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>