<?= $this->extend('admin/layout/main_layout'); ?>

<?= $this->section('content') ?>
<div class="br-mainpanel">
    <!-- BREADCRUMB -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="<?= base_url('panel/dashboard'); ?>">Dashboard</a>
          <a class="breadcrumb-item" href="javascript:void(0)">Konten</a>
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
                <div class="dataTables_length pd-b-5">
                  <button onclick="_btnAdd()" class="btn btn-info btn-with-icon mg-b-10" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;">
                    <div class="ht-40">
                     <span class="icon wd-35"><i class="icon-pencil"></i></span>
                     <span class="pd-x-10 tx-12">TAMBAH DATA</span>
                    </div>
                  </button>
                </div>
                </div>
                </div>                                        
                </div>
                <!-- END BUTTON ADD -->
                <!-- TABLE -->
                <?= form_open('Backend/Laporandpl/multi_del', ['class' => 'formMultiDelete']) ?>
                <table id="viewTable" class="table display responsive w-100">
                  <thead>
                    <tr>
                      <th class="wd-5p tx-center">
                        <button type='submit' class='btn btn-sm btn-danger' style="margin-bottom:5px;">
                          <i class="fa fa-trash-o"></i>
                        </button>
                        <label class="ckbox mg-b-0 tx-center" style='cursor:pointer;margin-left:5px;float:left;'>
                          <input type="checkbox" id="checkAll"><span></span>
                        </label> 
                      </th>
                      <th class="tx-center">surat tugas dosen pembimbing</th>
                      <th class="wd-10p tx-center">Aksi</th>
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
    <div id="formData" class="br-pagebody d-none"></div>
    <!-- END SECTION FORM -->
    <div class='modal fade' id='modaldetail' role='dialog' aria-hidden='true'></div>
<?= $this->endSection() ?>