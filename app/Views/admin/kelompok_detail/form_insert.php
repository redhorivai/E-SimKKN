<div class='br-section-wrapper'>
    <h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Tambah Data</h6>
    <p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>

    <?= form_open('Backend/Kelompok_detail/insert_data', ['class' => 'formsubmit']) ?>
    <?= csrf_field() ?>
    <div class='form-layout form-layout-1'>
        <div class="form_more">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Data Detail Kelompok</h6>
            <?php foreach ($data1 as $res1) :?>

            <div class='nambah row'>
                <div class='col-lg-6'>
                    <div class='form-group'>
                        <label class='form-control-label tx-bold'>Nama Kelompok: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='nama' name='nama' onchange='remove(id)'>
                    </div>
                </div>
                <div class='col-lg-6'>
                    <div class='form-group'>
                        <label class='form-control-label tx-bold'>Periode: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='periode_id' name='periode_id' data-placeholder='-- Pilih Periode --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            <option value="<?= $res1->id?>"><?= $res1->periode_nm?></option>
                <?php endforeach ?>
                        </select>
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
                <a href="<?php base_url('panel/kelompok_detail') ?>" class='btn btn-light'>Batal</a>
            </div>
        </div>
        <?= form_close() ?>

    </div>