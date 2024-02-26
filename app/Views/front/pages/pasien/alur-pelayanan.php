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
    <section class="position-inherit">
      <div class="container">
        <div class="row">
          <?= $resTitle; ?>
          <?= $resContent; ?>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>