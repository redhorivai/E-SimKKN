<?php foreach($data1 as $key1): ?>
<div class='br-section-wrapper'>
    <h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6>
    <p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>

    <?= form_open('Backend/Aturkelompok/update_data', ['class' => 'formupdate']) ?>
    <?= csrf_field() ?>
    <input type='input' name='kelompok_id' value='<?= $key1->kelompok_id; ?>'>
    <div class='form-layout form-layout-1'>
        <div class="form_more">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Data Detail Kelompok</h6>
            <div class='nambah row'>
            <div class='col-lg-4'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Kelompok: <span class='tx-danger'>*</span></label>
                    <select class='form-control select2' id='kelompok_id' name='kelompok_id[]' data-placeholder='-- Pilih Kelompok --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                    <?php foreach ($data3 as $key3 ):?>
                    <option <?php ($key3->id == $key1->kelompok_id ? "selected='selected'" : "") ?> value='<?= $key3->id ?>'><?= $key3->nama?></option>
                    <?php endforeach?>
                    </select>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Dosen/Ketua/Anggota: <span class='tx-danger'>*</span></label>
                    <select class='form-control select2' id='user_id' name='user_id[]' data-placeholder='-- Pilih Nama --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                    <?php foreach ($data2 as $key2 ):?>
                    <option <?php ($key2->user_id == $key1->user_id ? "selected='selected'" : "") ?> value='<?= $key2->user_id ?>'><?= $key2->name?></option>
                    <?php endforeach?>
                    </select>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='form-group'>
                        <label class='form-control-label tx-bold'>Status: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='status_user' name='status_user[]' data-placeholder='-- Pilih Status Kelompok --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        <option <?= ($key1->status_user == "dosen" ? "selected='selected'" : "") ?> value='dosen'>Dosen</option>
                        <option <?= ($key1->status_user == "ketua" ? "selected='selected'" : "") ?> value='ketua'>Ketua</option>
                        <option <?= ($key1->status_user == "anggota" ? "selected='selected'" : "") ?> value='anggota'>Anggota</option>
                        </select>
                    </div>
                </div>                    
            </div>
        </div>
        <div class='text-center'>
            <button type='button' onclick='_btnMore()' class='btn btn-outline-primary bd-1 mg-t-10'>
            <span style='font-size:14px;text-transform:capitalize;'>Tambah Indikator & Value</span>
            </button>
        </div>
        <hr>
        <div class='form-layout-footer text-center mg-t-20'>
            <button type='submit' class='btn btn-success btnupdate'>Update</button>
            <a href="<?php base_url('panel/imut') ?>" class='btn btn-light'>Batal</a>
        </div>
    </div>
    <?= form_close() ?>
    
</div>
<?php endforeach ?>

<script>
    function _btnMore(){
        $('.form_more').append(`
            <div class='nambah row'>
                <div class='col-lg-8'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Indikator Grafik: <span class='tx-danger'>*</span></label>
                    <input class='form-control' type='text' id='indicator_nm' name='indicator_nm[]' onchange='remove(id)'>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='form-group'>
                        <label class='form-control-label tx-bold'>Value (Nilai): <span class='tx-danger'>*</span></label>
                        <div class='input-group'>
                        <input class='form-control' type='text' id='indicator_value' name='indicator_value[]' onchange='remove(id)'>
                        <span class='input-group-btn'>
                            <button type='button' id='btnRemove' class='btn bd bg-white tx-danger'>
                                <i class='fa fa-close'></i>
                            </button>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        `)
    }

    function _btnDel(chart_id, indicator_id, indicator_nm, indicator_value) {
        Swal.fire({
          title: 'Hapus Data?',
          html: `<p class="mg-b-10">Anda akan menghapus data indikator:</p><p class='mg-b-2'>Indikator: <b>${indicator_nm}</b></p><p>Value (Nilai): <b>${indicator_value}</b></p>`,
          icon: 'warning',
          showCancelButton: true,
          showConfirmButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak, batalkan',
          confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "POST",
                url: "<?= site_url('Backend/Imut/del_indicator') ?>",
                data: {
                    indicator_id: indicator_id
                },
                dataType: "JSON",
                success: function(response) {
                  if (response.sukses) {
                    Toast.fire({
                      icon: "success",
                      title: response.sukses,
                    });
                    _btnEdit(chart_id);
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
              });
            }
        });
    }
        
$(document).ready(function(e){    
    $('.select2').select2();
    $(document).on('click','#btnRemove',function(e) {
        e.preventDefault();  
        $(this).closest('.nambah').remove();
    });

    $('.formupdate').submit(function(e){
        e.preventDefault();
        var chart_category  = $("#chart_category").val();
        var chart_type      = $("#chart_type").val();
        var chart_nm        = $("#chart_nm").val();
        var chart_periode   = $("#chart_periode").val();
        var indicator_nm    = $("#indicator_nm").val();
        var indicator_value = $("#indicator_value").val();

        if (chart_category == "") {
            $("#chart_category + span").addClass("is-invalid");
            $("#chart_category + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#chart_category').removeClass('is-invalid');
            $("#chart_category + span").removeClass("is-invalid");
            $("#chart_category + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (chart_type == "") {
            $("#chart_type + span").addClass("is-invalid");
            $("#chart_type + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#chart_type').removeClass('is-invalid');
            $("#chart_type + span").removeClass("is-invalid");
            $("#chart_type + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (chart_nm == "") {
            // $('#chart_nm').focus();
            $('#chart_nm').addClass('is-invalid');
        } else {
            $('#chart_nm').removeClass('is-invalid');
        }
        if (chart_periode == "") {
            $('#chart_periode').addClass('is-invalid');
        } else {
            $('#chart_periode').removeClass('is-invalid');
        }
        if (indicator_nm == "") {
            $('#indicator_nm').addClass('is-invalid');
        } else {
            $('#indicator_nm').removeClass('is-invalid');
        }
        if (indicator_value == "") {
            $('#indicator_value').addClass('is-invalid');
        } else {
            $('#indicator_value').removeClass('is-invalid');
        }
        if (chart_category && chart_type && chart_nm && chart_periode && indicator_nm && indicator_value) {
            $.ajax({
                type     : "POST",
                url      : $(this).attr('action'),
                data     : $(this).serialize(),
                dataType : "JSON",
                beforeSend: function(){
                    $('.btnupdate').attr("disabled", "disabled");
                    $('.btnupdate').html('<i class="fa fa-spin fa-spinner"></i> Proses');
                },
                complete: function(){
                    $('.btnupdate').removeAttr("disabled");
                    $('.btnupdate').html("Update");
                },
                success: function(response){
                    if(response.sukses){
                        Swal.fire({
                            title : 'Berhasil',
                            html  : response.sukses,
                            icon  : 'success',
                            showConfirmButton: true,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href=("<?= site_url('panel/imut') ?>");
                            }
                        });
                    }
                    if (response.gagal){
                        $("#chart_periode").focus();
                        $('#chart_periode').addClass('is-invalid');
                        Swal.fire({
                            title : 'Pemberitahuan',
                            html  : response.gagal,
                            icon  : 'warning',
                            showConfirmButton: true,
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
        }
    });
});
</script>