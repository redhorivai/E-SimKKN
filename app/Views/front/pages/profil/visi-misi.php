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
          <div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20">
            <h3 class="title mb-20 text-center">MAKLUMAT</h3>
            <ul class="list-border-bottom no-padding mb-30">
              <li>
                <h5>DENGAN INI KAMI BESERTA SELURUH PEGAWAI, DI LINGKUNGAN RUMAH SAKIT UMUM DAERAH PALEMBANG BARI, MENYATAKAN SIAP MEMBERIKAN PELAYANAN, SESUAI DENGAN STANDAR PELAYANAN. DAN APABILA TIDAK MEMBERIKAN SESUAI DENGAN STANDAR YANG TELAH DITETAPKAN, KAMI SIAP MENERIMA SANKSI, SESUAI DENGAN PERATURAN PERUNDANG-UNDANGAN YANG BERLAKU.</h5>
              </li>
            </ul>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 pb-sm-20">
            <h3 class="title mb-30 line-bottom">Visi</h3>
            <ul class="list-border-bottom no-padding">
              <li>
                <h5>Menjadi Rumah Sakit Unggul, Amanah, dan Terpercaya di Indonesia.</h5>
              </li>
            </ul>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 pb-sm-20">
            <h3 class="title mb-30 line-bottom">Misi</h3>
            <ul class="list theme-colored angle-double-right">
              <li>Meningkatkan kualitas pelayanan kesehatan dengan berorientasi pada keselamatan dan ketepatan sesuai standar mutu berdasarkan pada etika dan profesionalisme yang menjangkau seluruh lapisan masyarakat</li>
              <li>Meningkatkan mutu manajemen sumber daya kesehatan</li>
              <li>Menjadikan RSUD Palembang BARI sebagai rumah sakit pendidikan dan pelatihan di Indonesia</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>