<div class='br-section-wrapper'>
    <h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Tambah Data</h6>
    <p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>

    <?= form_open('Backend/Aturkelompok/insert_data', ['class' => 'formsubmit']) ?>
    <?= csrf_field() ?>
    <div class='form-layout form-layout-1'>
        <div class="form_more">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Data Detail Kelompok</h6>
            <div class='nambah row'>
            <div class='col-lg-4'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Kelompok: <span class='tx-danger'>*</span></label>
                    <select class='form-control select2' id='kelompok_id' name='kelompok_id[]' data-placeholder='-- Pilih Kelompok --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                    <option value=''></option>
                    <?php foreach ($data2 as $key2):?>
                    <option value='<?= $key2->id ?>'><?= $key2->nama ?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Dosen/Ketua/Anggota: <span class='tx-danger'>*</span></label>
                    <select class='form-control select2' id='user_id' name='user_id[]' data-placeholder='-- Pilih Nama --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                    <option value=''></option>
                    <?php foreach ($data1 as $key1):?>
                    <option value='<?= $key1->user_id ?>'><?= $key1->name . " ($key1->level) "?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='form-group'>
                        <label class='form-control-label tx-bold'>Status: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='status_user' name='status_user[]' data-placeholder='-- Pilih Status Kelompok --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        <option value='dosen'>Dosen</option>
                        <option value='ketua'>Ketua</option>
                        <option value='anggota'>Anggota</option>
                        </select>
                    </div>
                </div>                    
            </div>
        </div>
        <div class='text-center'>
            <button type='button' onclick='_btnMore()' class='btn btn-outline-primary bd-1 mg-t-10'>
            <span style='font-size:14px;text-transform:capitalize;'>Tambah Ketua/Anggota & Status</span>
            </button>
        </div>
        <hr>
        <div class='form-layout-footer text-center mg-t-20'>
            <button type='submit' class='btn btn-info btnsimpan'>Simpan</button>
            <a href="<?php base_url('panel/aturkelompok') ?>" class='btn btn-light'>Batal</a>
        </div>
    </div>
    <?= form_close() ?>
    
</div>

<script>
    function _btnMore(){
        $('.form_more').append(`
            <div class='nambah row'>
                <div class='col-lg-4'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Kelompok: <span class='tx-danger'>*</span></label>
                    <select class='form-control select2' id='kelompok_id' name='kelompok_id[]' data-placeholder='-- Pilih Kelompok --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                    <option value=''></option>
                    <?php foreach ($data2 as $key2):?>
                    <option value='<?= $key2->id ?>'><?= $key2->nama ?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Dosen/Ketua/Anggota: <span class='tx-danger'>*</span></label>
                    <select class='form-control select2' id='user_id' name='user_id[]' data-placeholder='-- Pilih Nama --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                    <option value=''></option>
                    <?php foreach ($data1 as $key1):?>
                    <option value='<?= $key1->user_id ?>'><?= $key1->name . " ($key1->level) "?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='form-group'>
                        <label class='form-control-label tx-bold'>Status: <span class='tx-danger'>*</span></label>
                        <div class='input-group'>
                        <select class='form-control select2' id='status_user' name='status_user[]' data-placeholder='-- Pilih Status Kelompok --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        <option value='dosen'>Dosen</option>
                        <option value='ketua'>Ketua</option>
                        <option value='anggota'>Anggota</option>
                        </select>
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
    function remove(id) {
        if (id != 'kelompok_id' && id!= 'user_id' && id!= 'status_user') {
            $('#' + id).removeClass('is-invalid');
        } else {
            $('#' + id).removeClass('is-invalid');
            $('#' + id + '+ span').removeClass("is-invalid");
            $('#' + id + '+ span').focus(function() {
                $(this).removeClass("is-invalid");
            });
        }        
    }
    $(document).ready(function(e){   
        $('.select2').select2();

        $(document).on('click','#btnRemove',function(e) {
            e.preventDefault();  
            $(this).closest('.nambah').remove();
        });

        $('.formsubmit').submit(function(e){
            e.preventDefault();
            var kelompok_id  = $("#kelompok_id").val();
            var user_id      = $("#user_id").val();
            var status_user        = $("#status_user").val();

            if (kelompok_id == "") {
                $("#kelompok_id + span").addClass("is-invalid");
                $("#kelompok_id + span").focus(function() {
                    $(this).addClass("is-invalid");
                });
            } else {
                $('#kelompok_id').removeClass('is-invalid');
                $("#kelompok_id + span").removeClass("is-invalid");
                $("#kelompok_id + span").focus(function() {
                    $(this).removeClass("is-invalid");
                });
            }
            if (user_id == "") {
                $("#user_id + span").addClass("is-invalid");
                $("#user_id + span").focus(function() {
                    $(this).addClass("is-invalid");
                });
            } else {
                $('#user_id').removeClass('is-invalid');
                $("#user_id + span").removeClass("is-invalid");
                $("#user_id + span").focus(function() {
                    $(this).removeClass("is-invalid");
                });
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
            if (kelompok_id && user_id && status_user) {
                $.ajax({
                    type     : "POST",
                    url      : $(this).attr('action'),
                    data     : $(this).serialize(),
                    dataType : "JSON",
                    beforeSend: function(){
                        $('.btnsimpan').attr("disabled", "disabled");
                        $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i> Proses');
                    },
                    complete: function(){
                        $('.btnsimpan').removeAttr("disabled");
                        $('.btnsimpan').html("Simpan");
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
                                    window.location.href=("<?= site_url('panel/aturkelompok') ?>");
                                }
                            });
                        }
                        if (response.gagal){
                            $("#kelompok_id").focus();
                            $('#kelompok_id').addClass('is-invalid');
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