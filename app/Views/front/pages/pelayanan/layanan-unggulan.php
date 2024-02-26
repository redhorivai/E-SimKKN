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
                <li><a href="<?= base_url('/pelayanan'); ?>">Pelayanan</a></li>
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
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1">5 Layanan Unggulan RSUD Palembang BARI</h2>
              <div class="title-icon">
                <img class="mb-10" src="<?= base_url(); ?>/assets-front/images/title-icon.png">
              </div>
              <p>Layanan unggulan adalah suatu layanan didukung oleh teknologi terbaik dibidangnya, komprehensif pada layanan klinik berfokus pada penyakit tertentu.</p>
            </div>
          </div>
        </div>
        <div class="section-centent">
          <div class="row">
            <?= $resContent; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>