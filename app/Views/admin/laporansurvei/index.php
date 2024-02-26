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
    <div id="viewData" class="br-pagebody">
        <div class="br-section-wrapper">
            <div class="table-wrapper">
                <!-- BUTTON ADD -->
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                <div class="col-sm-12">
                <!--  -->
                </div>
                </div>                                        
                </div>
                <!-- END BUTTON ADD -->
                <!-- TABLE -->
                <table id="viewTable" class="table display responsive w-100">
                  <thead>
                    <tr>
                      <th class="wd-5p tx-center">
                      </th>
                      <th class="tx-center">surat laporan survei</th>
                      <th class="wd-10p tx-center">Aksi</th>
                    </tr>
                  </thead>
                </table>
                <!-- END TABLE -->
            </div>
        </div>
    </div>
    <!-- END SECTION TABLE -->
    <!-- SECTION FORM -->
    <div id="formData" class="br-pagebody d-none"></div>
    <!-- END SECTION FORM -->
    <div class='modal fade' id='modaldetail' role='dialog' aria-hidden='true'></div>
<?= $this->endSection() ?>