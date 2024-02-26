<?= $this->extend('front/layout/main_layout') ?>
<?= $this->section('content'); ?>
<!-- MAIN CONTENT -->
<div class="main-content">
    <!-- SECTION: BREADCRUMB -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-color="#CCC">
      <div class="container pt-30 pb-30">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title"><?= $title; ?></h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="<?= base_url('/'); ?>">Beranda</a></li>
                <li><a href="<?= base_url('/pasien/alur_pelayanan'); ?>">Pasien & Pengunjung</a></li>
                <li class="active text-theme-colored"><?= $title; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT -->
    <section>
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <div class="service-content ml-20 ml-sm-0">
                <h3 class="title text-center mt-0 mb-30">Download BARI Mobile</h3>
                <div class="item text-center"> 
                  <a href="https://play.google.com/store/apps/details?id=com.okta.mobilebari" target="_blank">
                  <img src="<?= base_url(); ?>/assets-front/images/play_store.png" style="max-width:20%;">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>