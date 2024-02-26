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
        <div class="section-content">
          <div class="row multi-row-clearfix mb-50" style="display:flex;justify-content:center;">
            <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
              <div class="team maxwidth400">
                <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                  <div class="team-thumb">
                    <img class="img-fullwidth" src="<?= base_url(); ?>/assets-front/images/team/direktur.png">
                    <div class="team-overlay"></div>
                  </div>
                  <div class="team-details bg-silver-light pt-10 pb-10">
                    <h5 class="font-weight-600 m-5">dr. Hj. Makiani, S.H.,M.M.,MARS</h5>
                    <h6 class="text-theme-colored font-15 font-weight-400 mt-0">DIREKTUR</h6>                    
                    <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">
                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row multi-row-clearfix mb-50" style="display:flex;justify-content:center;">
            <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
              <div class="team maxwidth400">
                <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                  <div class="team-thumb">
                    <img class="img-fullwidth" src="<?= base_url(); ?>/assets-front/images/team/lg6.jpg">
                    <div class="team-overlay"></div>
                  </div>
                  <div class="team-details bg-silver-light pt-10 pb-10">
                    <h5 class="font-weight-600 m-5">Fathul Korib AS, S.I.P., M.M.,M.Si</h5>
                    <h6 class="text-theme-colored font-15 font-weight-400 mt-0">WADIR UMUM DAN KEUANGAN</h6>                    
                    <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">
                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
              <div class="team maxwidth400">
                <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                  <div class="team-thumb">
                    <img class="img-fullwidth" src="<?= base_url(); ?>/assets-front/images/team/lg9.jpg">
                    <div class="team-overlay"></div>
                  </div>
                  <div class="team-details bg-silver-light pt-10 pb-10">
                    <h5 class="font-weight-600 m-5">dr. Alfarobi, M.Kes</h5>
                    <h6 class="text-theme-colored font-15 font-weight-400 mt-0">WADIR PELAYANAN</h6>                    
                    <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">
                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                  </div>
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