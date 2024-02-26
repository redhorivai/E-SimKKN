<?= $this->extend('admin/layout/main_layout'); ?>

<?= $this->section('content') ?>
<div class="br-mainpanel">
    <!-- BREADCRUMB -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="<?= base_url('panel/dashboard'); ?>">Dashboard</a>
          <a class="breadcrumb-item" href="<?= base_url('panel/instansi'); ?>">Pengaturan</a>
          <span class="breadcrumb-item active"><?= $title; ?></span>
        </nav>
    </div>
    <!-- END BREADCRUMB -->
    <!-- SECTION TABLE -->
    <div class="br-pagebody">
        <div class="br-section-wrapper">
          <?php foreach ($profil as $res) : ?>
          <form class="form-layout form-layout-1 formcompany" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="company_id" value="<?= $res->company_id; ?>">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Informasi Dasar</h6>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label class="form-control-label tx-bold">Nama Instansi: <span class="tx-danger">*</span></label>
                  <input type="text" name="company_nm" id="company_nm" class="form-control" value="<?= $res->company_nm; ?>" onchange="remove(id)" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label tx-bold">e-Mail: <span class="tx-danger">*</span></label>
                  <input type="text" name="email" id="email" class="form-control" value="<?= $res->email; ?>" onchange="remove(id)" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label tx-bold">No. Telepon Utama: <span class="tx-danger">*</span></label>
                  <input type="text" name="cellphone_informasi" id="cellphone_informasi" class="form-control" value="<?= $res->cellphone_informasi; ?>" onchange="remove(id)" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label tx-bold">No. Telepon SMS Online:</label>
                  <input type="text" name="cellphone_sms_online" id="cellphone_sms_online" class="form-control" value="<?= $res->cellphone_sms_online; ?>" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label tx-bold">No. Telepon Pemasaran:</label>
                  <input type="text" name="cellphone_marketing" id="cellphone_marketing" class="form-control" value="<?= $res->cellphone_marketing; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label tx-bold">Alamat: <span class="tx-danger">*</span></label>
                  <textarea type="text" rows="4" name="addr_txt" id="addr_txt" class="form-control" onchange="remove(id)" readonly><?= $res->addr_txt; ?></textarea>
                </div>
              </div>
            </div>
            
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20 mg-b-20">Informasi Tambahan</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label tx-bold">Alamat Website:</label>
                  <input type="text" name="link_website" id="link_website" class="form-control" value="<?= $res->link_website; ?>" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label tx-bold">Facebook:</label>
                  <input type="text" name="facebook" id="facebook" class="form-control" value="<?= $res->facebook; ?>" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label tx-bold">Instagram:</label>
                  <input type="text" name="instagram" id="instagram" class="form-control" value="<?= $res->instagram; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label tx-bold">Logo Instansi:</label>
                  <div class="row">
                    <div class="col-sm-12 col-12">
                      <div class="fileinput fileinput-new" data-provides="fileinput">   
                        <div id="thumb" class="fileinput-new thumbnail bg-gray-600" style="border:2px solid #e2e2e2;border-radius:5px;padding:26px;">
                          <img src="<?= base_url(); ?>/assets-front/images/logo/<?= $res->company_logo; ?>">
                        </div>                      
                        <div class="fileinput-preview fileinput-exists thumbnail" style="border:2px solid #e2e2e2;border-radius:5px;padding:26px;"></div>
                        <div id="btnImg" class="d-none">
                          <span class="btn btn-sm btn-outline-info btn-file" style="cursor:pointer;">
                          <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                          <span class="fileinput-exists mr-1">Change</span>
                            <input type="file" name="company_logo" id="company_logo" />
                            <input type="hidden" name="logoLama" value="<?= $res->company_logo; ?>">
                          </span>
                          <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger fileinput-exists" data-dismiss="fileinput" style="cursor:pointer;" id="remove">Remove</a>
                        </div>                                                                               
                        <small class="errorLogo" style="color:#dc3545;font-size: 80%;margin-top: 0.25rem;"></small>
                      </div>                                     
                    </div>                                                            
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer form-layout-footer pl-0 pr-0 pb-0 justify-content-center">
              <div class="btn-group" role="group" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;">
                <button style="min-width:100px;" type="submit" class="btn btn-info" id="btnSimpan">Simpan</button>
                <button style="min-width:100px;border-radius:5px;" type="button" class="btn btn-success" id="btnUpdate">Update</button>
                <button style="min-width:100px;" type="button" class="btn btn-light" id="btnBatal">Batal</button>
              </div>
            </div>
          </form>
          <?php endforeach ?>
        </div>
    </div>
    <!-- END SECTION TABLE -->
<?= $this->endSection() ?>