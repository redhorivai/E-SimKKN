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
                                                <input type="date" name="tglAwal" id="tglAwal" value="<?= $tglAwalm?>" class="form-control bg-white tglSurat" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="control-label w-100"><b>Sampai Tanggal:</b></label>
                                                <input type="date" name="tglAkhir" id="tglAkhir" value="<?= $tglAkhirm?>" class="form-control bg-white tglSurat" required>
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
                                <div class='br-section-wrapper'>
                                    <h6 class='tx-gray-800 tx-center tx-uppercase tx-bold mg-b-0'>Laporan Harian Mahasiswa</h6>
                                    <h6 class='mg-b-20 tx-gray-600 tx-center tx-bold'>Periode: <b class='text-danger'><?= $tglAwal?></b> - <b class='text-danger'><?= $tglAkhir?></b></h6>
                                    <hr>
                                    <table class='table table-bordered tx-dark'>
                                        <thead style='background-color:rgba(214, 217, 218, 0.2)'>
                                            <tr>
                                                <th>Nama</th>
                                                <th class='tx-center'>Kelompok</th>
                                                <th class='tx-center'>File Laporan</th>
                                                <th class='tx-center'>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>".$data->name."</td>
                                                <td class='tx-center'>".$data->nama."</td>
                                                <td role='dialog' aria-hidden='true' class='tx-center'><a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block' style' style='color:#f90404;'>Lampiran</a></td>
                                                <td class='tx-center'><button type='button' class='btn btn-primary tx-12 tx-uppercase tx-mont tx-medium' style='min-width:50px;' onclick='_btnCek(\"$data->id\")'><span style='vertical-align:middle;'>Input</span></button></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan='4' class='text-center'>
                                                    <a href='".base_url()."/lapor/print_report' target='_blank' class='btn btn-outline-secondary tx-12 tx-uppercase tx-mont tx-medium'>
                                                        <span style='vertical-align:middle;'>Cetak Laporan</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
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