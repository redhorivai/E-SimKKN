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
                <li><a href="<?= base_url('/profil'); ?>">Profil</a></li>
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
          <div class="col-xs-12 col-sm-6 col-md-6 pb-sm-20">
            <h3 class="title mb-30 line-bottom">Tata Nilai</h3>
              <div class="list-group"> 
                <a href="javascript:void:(0)" class="list-group-item">
                  <h5 class="list-group-item-heading">Sinergi</h5>
                  <p class="list-group-item-text">Koordinasi, Kolaborasi, Satu Persepsi.</p>
                </a> 
                <a href="javascript:void:(0)" class="list-group-item">
                  <h5 class="list-group-item-heading">Integritas</h5>
                  <p class="list-group-item-text">Jujur, Disiplin, Konsisten, Komitmen dan  Menjadi Teladan</p>
                </a>
                <a href="javascript:void:(0)" class="list-group-item">
                  <h5 class="list-group-item-heading">Profesional</h5>
                  <p class="list-group-item-text">Tanggung Jawab, Kompeten, Bekerja Tuntas,  Akurat, Efektif dan Efisien</p>
                </a> 
              </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 pb-sm-20">
            <h3 class="title mb-30 line-bottom">Motto</h3>
            <ul class="list-border-bottom no-padding">
              <li>
                <h5><q> Kesembuhan Dan Kepuasan Pelanggan Adalah Kebahagian Kami </q></h5>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>