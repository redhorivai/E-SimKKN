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
                <li><a href="javascript:void(0)">Indikator Mutu</a></li>
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
        <!-- <php print_r ($chart) ?> -->
          <div class="row mb-50">

            <!-- GRAFIK -->
            <?= $grafik; ?>
            <!-- END GRAFIK -->
            
          </div>
        </div>
      </div>
    </section>

    <div class="clear"></div>
    <script type="text/javascript">
      window.onload = function(){
        <?= $script; ?>
      };
    </script>
    <!-- JS | Chart-->
    <script src="<?= base_url(); ?>/assets-front/js/Chart.js"></script>
    
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>