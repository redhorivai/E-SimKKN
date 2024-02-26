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
              <?php 
                if (!empty($dokterpoli->result[0]->org_id)){
                  echo "<h2 class='title'>Dokter ".$dokterpoli->result[0]->org_nm."</h2>";
                } else {
                  echo "<h2 class='title'>Dokter RSUD Palembang BARI</h2>";
                }
              ?>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="<?= base_url('/'); ?>">Beranda</a></li>
                <li><a href="<?= base_url('/informasi'); ?>">Informasi</a></li>
                <li><a href="<?= base_url('/informasi'); ?>"><?= $title; ?></a></li>
                <?php 
                  if (!empty($dokterpoli->result[0]->org_id)){
                    echo "<li class='active text-theme-colored'>Dokter ".$dokterpoli->result[0]->org_nm."</li>";
                  } else {
                    echo "<li class='active text-theme-colored'>Dokter RSUD Palembang BARI</li>";
                  }
                ?>
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
          <div class="row multi-row-clearfix">
            <?php 
              if ($dokterpoli->kode == '200'){
                foreach($dokterpoli->result as $res){
                  echo "<div class='col-xs-6 col-md-3 sm-text-center mb-30 mb-sm-30'>
                        <div class='team maxwidth200'>
                          <div class='thumb'>
                            <img class='img-fullwidth' src='".base_url()."/image/dokter/".$res->avatar."'>
                          </div>
                          <div class='content border-1px p-15 bg-light clearfix'>
                            <span style='min-height:100px;display:inline-block;'>
                            <h5 class='name text-theme-color-2 mt-0 mb-0'>".$res->person_nm."</h5>
                            <p class='mb-10 font-14'>".$res->org_nm."</p>
                            </span>

                            <a class='btn btn-theme-colored btn-block hvr-buzz-out' href='".base_url('/informasi/profil_dokter/'.$res->person_id.'')."'>Lihat Profil</a>
                          </div>
                        </div>
                      </div>";
                }
              } else {
                echo "<h5 class='text-center'><em>Belum ada data dokter.</em></h5>";
              }
            ?>
            
            
          </div>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>