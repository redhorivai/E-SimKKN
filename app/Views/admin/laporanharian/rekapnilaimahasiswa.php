<?= $this->extend('admin/layout/main_layout'); ?>

<?= $this->section('content') ?>
<div class="br-mainpanel">
    <!-- BREADCRUMB -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="<?= base_url('panel/dashboard'); ?>">Dashboard</a>
          <span class="breadcrumb-item active"><?= $title; ?></span><span><?= $user_id; ?></span><span><?= $kelompok_id; ?></span>
        </nav>
    </div>
    <!-- END BREADCRUMB -->
    <!-- SECTION TABLE -->
    <div id="viewData" class="br-pagebody">
        <div class="br-section-wrapper">
            <div class="table-wrapper">
                <!-- TABLE -->
                <?= form_open('Backend/Lapor/multi_del', ['class' => 'formMultiDelete']) ?>
                <table id="viewTable" class="table display responsive w-100">
                  <thead>
                    <tr>
                      <th class="wd-5p tx-center">
                      </th>
                      <th class="tx-center">Rekap Nilai Harian Mahasiswa</th>
                    </tr>
                  </thead>
                </table>
                <?= form_close() ?>
                <!-- END TABLE -->
            </div>
        </div>
    </div>
    <!-- END SECTION TABLE -->

    <!-- SECTION FORM -->
    <!-- <div id="formData" class="br-pagebody d-none"></div> -->
    <!-- END SECTION FORM -->
<?= $this->endSection() ?>