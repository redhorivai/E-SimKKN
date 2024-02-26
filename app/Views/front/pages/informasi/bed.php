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

        <div class="row">
          <?php foreach($databed as $key): ?>
          <div class="col-xs-6 col-md-2">
            <div class="card effect__hover" style="min-height: 195px !important;">
              <div class="card__front bg-theme-colored" data-height="165">
                <div class="card__text">
                  <div class="display-table-parent">
                    <div class="display-table">
                      <div class="display-table-cell">
                        <div class="icon-box mb-0"> 
                          <!-- <i class="text-white pe-7s-users font-72"></i> -->
                          <img src="<?= base_url(); ?>/assets-front/images/bari.png">
                          <h5 class="icon-box-title text-uppercase text-white"><?= $key->nama_kelas; ?></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card__back" data-bg-color="#e0e0e0" data-height="165">
                <div class="card__text">
                  <div class="display-table-parent p-30">
                    <div class="display-table">
                      <div class="display-table-cell">
                        <h1 class="text-uppercase"><?= $key->jumlah_kosong; ?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div role="alert" class="alert alert-warning"> 
              <strong>Keterangan</strong><br>
              <ol>
                <li>- Arahkan kursor ke ruangan untuk mengetahui jumlah ketersediaan masing-masing tempat tidur.</li>
                <li>- Ketersediaan tempat tidur dapat berubah sewaktu-waktu.</li>
                <li>- Untuk informasi lebih lanjut, silahkan hubungi bagian admisi kami di nomor <b>(0711) 519 211</b>.</li>
              </ol> 
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>