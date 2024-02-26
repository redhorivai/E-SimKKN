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
    <div class="br-pagetitle">
        <i class="fe-file-text tx-50" style="color:#343a40"></i>
        <div>
            <h4 style="margin-bottom:0 !important;">Report Laporan Harian Mahasiswa</h4>
            <p class="mg-b-0">Silahkan pilih jangka waktu tanggal awal dan tanggal akhir untuk menyortir laporan Harian.</p>
        </div>
    </div>
    <div id="" class="br-pagebody">
        <div class="br-section-wrapper">
            <div class="table-wrapper">
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="dataTables_length">

                                <form class='form-data'>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="control-label w-100"><b>Dari Tanggal:</b></label>
                                                <input type="date" name="tglAwal" id="tglAwal" class="form-control bg-white tglSurat" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="control-label w-100"><b>Sampai Tanggal:</b></label>
                                                <input type="date" name="tglAkhir" id="tglAkhir" class="form-control bg-white tglSurat" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label w-100">&nbsp;</label>
                                                <div class="btn-group" style="min-height:40.6px;">
                                                    <a href="<?= base_url('panel/laporan-harian-mahasiswa') ?>" class="btn btn-light tx-12 tx-uppercase tx-mont tx-medium">
                                                        <span style="vertical-align:middle;">Muat Ulang</span>
                                                    </a>
                                                    <button type="button" class="btn btn-info tx-12 tx-uppercase tx-mont tx-medium" style="min-width:101px;" onclick="_btnReport()">
                                                        <span style="vertical-align:middle;">Proses</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- END SECTION TABLE -->

    <!-- SECTION FORM -->
    <div id="formData" class="br-pagebody d-none"></div>
    <!-- END SECTION FORM -->
    <div class='modal fade' id='modaldetail' role='dialog' aria-hidden='true'></div>
    <div class='modal fade' id='modaldetail1' role='dialog' aria-hidden='true'></div>
    <?= $this->endSection() ?>