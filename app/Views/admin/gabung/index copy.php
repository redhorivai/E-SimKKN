<?= $this->extend('admin/layout/main_layout'); ?>

<?= $this->section('content') ?>

<div class="br-mainpanel">
    <!-- BREADCRUMB -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="<?= base_url('panel/dashboard'); ?>">Dashboard</a>
          <span class="breadcrumb-item active"><?= $title; ?></span>
        </nav>
    </div>
    <!-- END BREADCRUMB -->
    <!-- SECTION TABLE -->
    <div class='br-section-wrapper'>
    <h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Tambah Data</h6>
    <p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>
    <?= form_open('Backend/Gabung/insert_data', ['class' => 'formsubmit']) ?>
    <?= csrf_field() ?>
    <div class='form-layout form-layout-1'>
        <div class="form_more">
        <h6 class="tx-gray-800 text-center tx-uppercase tx-bold tx-14 mg-b-20">Tambah data<br>Kelompok / Posko</h6>
        <div class='row'>
          <div class="col-md-5">
              <div class="form-group">
                  <label class="form-control-label tx-bold">Kelompok/Posko: <span class='tx-danger'>*</span></label>
                  <select class="form-control select2" name="kelompok_id[]" id="kelompok_id" data-placeholder="-- Pilih Posko --" data-allow-clear="true" style="width:100%" onchange="remove(id)">
                    <option value=""></option>
                    <?php foreach ($kelompok as $key ) : ?>
                      <option value="<?= $key->id?>"><?= $key->nama ?></option>
                    <?php endforeach; ?>
                  </select>
              </div>
          </div>
          <div class="col-md-5">
              <div class="form-group">
                  <label class="form-control-label tx-bold">Status Pengguna: <span class='tx-danger'>*</span></label>
                  <select class="form-control select2" name="status_user[]" id="status_user" data-placeholder="-- Pilih Status --" data-allow-clear="true" style="width:100%" onchange="remove(id)">
                    <option value=""></option>
                    <option value="ketua">Ketua</option>
                    <option value="anggota">Anggota</option>
                  </select>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-group">
              <input type='text' name='user_id' value='<?= $user_id ?>'>
              </div>
          </div>
        </div>
        <hr>
        <div class='form-layout-footer text-center mg-t-20'>
            <button type='submit' class='btn btn-info btnsimpan' onclick="_simpan()">Simpan</button>
        </div>
    </div>
    <?= form_close() ?>
</div>
    <!-- END SECTION TABLE -->
<?= $this->endSection() ?>

<script type="text/javascript">
    function remove(id) {
        if (id != 'type') {
            $('#' + id).removeClass('is-invalid');
        } else {
            $('#' + id).removeClass('is-invalid');
            $('#' + id + '+ span').removeClass("is-invalid");
            $('#' + id + '+ span').focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
    }
    function _simpan() {
        var user_id   = $("#user_id").val();
        var kelompok_id      = $("#kelompok_id").val();
        var status_user = $("#status_user").val();

        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        ajaxData.append('user_id', user_id);
        ajaxData.append('kelompok_id', user_id);
        ajaxData.append('status_user', status_user);
        if (user_id == "") {
            $('#user_id').focus();
            $('#user_id').addClass('is-invalid');
        } else {
            $('#user_id').removeClass('is-invalid');
        }
        if (kelompok_id == "") {
            $('#kelompok_id').focus();
            $('#kelompok_id').addClass('is-invalid');
        } else {
            $('#kelompok_id').removeClass('is-invalid');
        }
        if (status_user == "") {
            $("#status_user + span").addClass("is-invalid");
            $("#status_user + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#status_user').removeClass('is-invalid');
            $("#status_user + span").removeClass("is-invalid");
            $("#status_user + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (user_id && kelompok_id && status_user) {
          $.ajax({
              url: "<?= site_url('Backend/Gabung/insert_data'); ?>",
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
                          title: "Data Gabung Kelompok / Posko berhasil"
                      });
                      $('.form-data')[0].reset();
                      $('#formData').addClass('d-none');
                      $('#viewData').delay(100).fadeIn();
                      $('#viewTable').DataTable().ajax.reload();
                  } else {
                      $("#user_id").focus();
                      $('#user_id').addClass('is-invalid');
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
    // $(document).ready(function(e){

    //     $('.formsubmit').submit(function(e){
    //         e.preventDefault();
    //         var user_id      = $("#user_id").val();
    //         var kelompok_id = $("#kelompok_id").val();
    //         var status_user            = $("#status_user").val();

    //         if (user_id == "") {
    //             $('#user_id').addClass('is-invalid');
    //         } else {
    //             $('#user_id').removeClass('is-invalid');
    //         }
    //         if (kelompok_id == "") {
    //             $('#kelompok_id').addClass('is-invalid');
    //         } else {
    //             $('#kelompok_id').removeClass('is-invalid');
    //         }
    //         if (status_user == "") {
    //             $("#status_user + span").addClass("is-invalid");
    //             $("#status_user + span").focus(function() {
    //                 $(this).addClass("is-invalid");
    //             });
    //         } else {
    //             $('#status_user').removeClass('is-invalid');
    //             $("#status_user + span").removeClass("is-invalid");
    //             $("#status_user + span").focus(function() {
    //                 $(this).removeClass("is-invalid");
    //             });
    //         }
    //         if (user_id && kelompok_id && status_user ) {
    //              $.ajax({
    //             url: "<?= site_url('Backend/Gabung/insert_data') ?>",
    //             type: "POST",
    //             data: {
    //                 user_id         : user_id,
    //                 kelompok_id     : kelompok_id,
    //                 status_user     : status_user,
    //             },
    //             success: function(response) {
    //                 if (response == "Sukses") {
    //                     Toast.fire({
    //                         icon: "success",
    //                         title: "Data Gabung Kelompok / Posko berhasil ditambahkan"
    //                     });
    //                     $('.form-data')[0].reset();
    //                     $('#formData').addClass('d-none');
    //                     $('#viewData').delay(100).fadeIn();
    //                     $('#viewTable').DataTable().ajax.reload();
    //                 } else {
    //                     $("#kelompok_id").focus();
    //                     $('#kelompok_id').addClass('is-invalid');
    //                     Swal.fire({
    //                         title: 'Pemberitahuan',
    //                         html: response,
    //                         icon: 'warning',
    //                         showConfirmButton: true,
    //                     });
    //                 }
    //             },
    //             error: function() {
    //                 Toast.fire({
    //                     icon: "error",
    //                     title: "Error !, Silahkan coba beberapa saat lagi."
    //                 });
    //             }
    //         });
    //         }
    //     });
    // });
    
</script>