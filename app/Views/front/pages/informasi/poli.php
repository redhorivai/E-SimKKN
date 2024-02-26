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
              <li><a href="<?= base_url('/informasi'); ?>">Informasi</a></li>
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
            <h2 class="mt-0 line-height-1">Dokter RSUD Palembang BARI</h2>
            <div class="title-icon">
              <img class="mb-10" src="<?= base_url(); ?>/assets-front/images/title-icon.png">
            </div>
            <p>Kami memiliki berbagai dokter terbaik dibidangnya, dan siap memberikan pelayanan yang terbaik untuk Anda dan keluarga.</p>
          </div>
        </div>
      </div>

      <div class="section-content">
        <div class="row">
          <div class="col-lg-12 col-sm-12 col-md-4 mb-sm-30 wow fadeInLeft animation-delay1">
            <div class="row text-center">
              <?php foreach ($datapoli as $res) : ?>
              <div class="col-lg-3 col-xs-6">
                <div class="icon-box iconbox-border2 iconbox-theme-colored p-20" style="min-height:180px;">
                  <a href="<?php base_url() ?>/informasi/dokter_poli/<?= $res->org_id; ?>" class="icon icon-gray icon-bordered" style="border:none;">
                    <img src="<?= base_url(); ?>/image/iconPoli/<?= $res->img_text; ?>" style="max-width:60%;">
                  </a>
                  <h5 class="icon-box-title font-14">
                    <a href="<?php base_url() ?>/informasi/dokter_poli/<?= $res->org_id; ?>"><?= $res->org_nm; ?></a>
                  </h5>
                </div>
              </div>
              <?php endforeach ?>
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