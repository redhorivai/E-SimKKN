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
            <h2 class="title">Survei Kepuasan Masyarakat</h2>
            <ol class="breadcrumb text-center text-black mt-10">
              <li><a href="<?= base_url('/'); ?>">Beranda</a></li>
              <li><a href="<?= base_url('/pasien'); ?>">Pasien</a></li>
              <li class="active text-theme-colored">Survei Kepuasan Masyarakat</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTENT -->
  <form id="form_skm" name="form_skm" style="border-right-width:medium;" class="forms">
    <section>
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <h3 class="title text-center mt-50 mb-30"><u>Pengisian Biodata</u></h3>
              <div class="item">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nama <small>*</small></label>
                      <input name="nm_koresponden" id="nm_koresponden" class="form-control" type="text" placeholder="Masukkan Nama" required="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class='form-group'>
                      <label class='form-control-label tx-bold'>Jenis Kelamin: <span class='tx-danger'>*</span></label>
                      <select class='form-control select2' id='jenis_kelamin' name='jenis_kelamin' data-placeholder='-- Pilih Jenis Kelamin --' data-allow-clear='true' style='width:100%'>
                        <option value=''></option>
                        <option value='l'>Laki-Laki</option>
                        <option value='p'>Perempuan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Pendidikan <small>*</small></label>
                      <select class='form-control select2' id='jenis_pendidikan' name='jenis_pendidikan' data-placeholder='-- Pilih Jenis Pendidikan --' data-allow-clear='true' style='width:100%'>
                        <option value=''></option>
                        <option value='s2'>Magister</option>
                        <option value='s1'>Sarjana</option>
                        <option value='sma'>Sekolah Menegah Atas</option>
                        <option value='smp'>Sekolah Menegah Pertama</option>
                        <option value='sd'>Sekolah Dasar</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Pekerjaan <small>*</small></label>
                      <select class='form-control select2' id='pekerjaan' name='pekerjaan' data-placeholder='-- Pilih Jenis Pekerjaan --' data-allow-clear='true' style='width:100%'>
                        <option value=''></option>
                        <option value='tni'>TNI</option>
                        <option value='polri'>Polri</option>
                        <option value='wirausaha'>Wirausaha</option>
                        <option value='pns'>PNS</option>
                        <option value='swasta'>Swasta</option>
                        <option value='lain'>Lainnya</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <dv class="form-group">
                      <label style="text-align:center">Jenis Layanan <small>*</small></label>
                      <select class='form-control select2' id='jenis_layanan' name='jenis_layanan' data-placeholder='-- Pilih Jenis Layanan --' data-allow-clear='true' style='width:100%'>
                        <option value=''></option>
                        <option value='graha'>Graha Eksekutif</option>
                        <option value='igd'>IGD</option>
                        <option value='rajal'>Rawat Jalan</option>
                        <option value='ranap'>Rawat Inap</option>
                        <option value='labor'>Laboratorium</option>
                        <option value='rontgen'>Rontgen</option>
                      </select>
                    </dv>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <section>
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <h3 class="title text-center mt-50 mb-30"><u>Kuisioner Survei Kepuasan Masyarakat</u></h3>
              <?php
              echo $soal_skm;
              ?>
            </div>
          </div>
        </div>
    </section>
    <div class="form-group text-center" style="margin-top:70px;margin-bottom:30px">
      <button type="button" class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" onclick="_simpanRespon()">Kirim</button>
      <button type="reset" class="btn btn-flat btn-light text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px">Reset</button>
    </div>
  </form>

  <!-- END CONTENT -->
</div>
<script type="text/javascript">
  function _simpanRespon() {
    var nm_koresponden    = $("#nm_koresponden").val();
    var jenis_kelamin     = $("#jenis_kelamin").val();
    var jenis_pendidikan  = $("#jenis_pendidikan").val();
    var pekerjaan         = $("#pekerjaan").val();  
    var jenis_layanan     = $("#jenis_layanan").val();
    var myArray           = $('#kuisfrm input:radio:checked').map(function() {
      if (this.id == "jawaban_id") {
        return {
          id: "jawaban_id",
          nilai: $(this).val(),
          soal_id: $(this).data("soal_id"),
          jawaban_id: $(this).data("jawaban_id"),
        };
      } else {
        return {
          id: this.id,
          nilai: $(this).val(),
          soal_id: $(this).data("soal_id"),
          jawaban_id: $(this).data("jawaban_id"),
        };
      }
    }).get();

    const myJSON = JSON.stringify(myArray);
    var ajaxData = new FormData();
    ajaxData.append('action', 'forms');
    ajaxData.append('nm_koresponden', nm_koresponden);
    ajaxData.append('jenis_kelamin', jenis_kelamin);
    ajaxData.append('jenis_pendidikan', jenis_pendidikan);
    ajaxData.append('pekerjaan', pekerjaan);
    ajaxData.append('jenis_layanan', jenis_layanan);
    ajaxData.append('myArray', myJSON);
    console.log(ajaxData)

    if (nm_koresponden == "") {
      $("#nm_koresponden").focus();
      $('#nm_koresponden').addClass('is-invalid');
    } else {
      $('#nm_koresponden').removeClass('is-invalid');
    }
    if (jenis_kelamin == "") {
      $("#jenis_kelamin + span").addClass("is-invalid");
      $("#jenis_kelamin + span").focus(function() {
        $(this).addClass("is-invalid");
      });
    } else {
      $('#jenis_kelamin').removeClass('is-invalid');
      $("#jenis_kelamin + span").removeClass("is-invalid");
      $("#jenis_kelamin + span").focus(function() {
        $(this).removeClass("is-invalid");
      });
    }
    if (jenis_pendidikan == "") {
      $("#jenis_pendidikan + span").addClass("is-invalid");
      $("#jenis_pendidikan + span").focus(function() {
        $(this).addClass("is-invalid");
      });
    } else {
      $('#jenis_pendidikan').removeClass('is-invalid');
      $("#jenis_pendidikan + span").removeClass("is-invalid");
      $("#jenis_pendidikan + span").focus(function() {
        $(this).removeClass("is-invalid");
      });
    }
    if (pekerjaan == "") {
      $("#pekerjaan + span").addClass("is-invalid");
      $("#pekerjaan + span").focus(function() {
        $(this).addClass("is-invalid");
      });
    } else {
      $('#pekerjaan').removeClass('is-invalid');
      $("#pekerjaan + span").removeClass("is-invalid");
      $("#pekerjaan + span").focus(function() {
        $(this).removeClass("is-invalid");
      });
    }
    if (jenis_layanan == "") {
      $("#jenis_layanan + span").addClass("is-invalid");
      $("#jenis_layanan + span").focus(function() {
        $(this).addClass("is-invalid");
      });
    } else {
      $('#jenis_layanan').removeClass('is-invalid');
      $("#jenis_layanan + span").removeClass("is-invalid");
      $("#jenis_layanan + span").focus(function() {
        $(this).removeClass("is-invalid");
      });
    }
    if (nm_koresponden && jenis_kelamin && jenis_pendidikan && pekerjaan && jenis_layanan) {
      $.ajax({
        url: "<?= site_url('Pasien/simpanrespon'); ?>",
        type: "POST",
        data: ajaxData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(response) {
          if (response == "Sukses") {
            Swal.fire({
              title: 'Pemberitahuan',
              html: response,
              icon: 'warning',
              showConfirmButton: true,
            });
            $('#form_skm')[0].reset();
          } else {
            $("#nm_koresponden").focus();
            Swal.fire({
              title: 'Berhasil',
              html: response.sukses,
              icon: 'success',
              showConfirmButton: true,
            }).then((result) => {
              if (result.value) {
                window.location.href = ("<?= site_url('pasien/kuisioner') ?>");
              }
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