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
                <li><a href="<?= base_url('/informasi/dokter_poli/'.$detaildokter->result->org_id.''); ?>">Dokter</a></li>
                <li class="active text-theme-colored"><?= $title; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT -->
    <section class="">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-sx-12 col-sm-4 col-md-4 mb-30">
              <div class="doctor-thumb">
                <img src="<?= base_url(); ?>/image/dokter/<?= $detaildokter->result->avatar; ?>">
              </div>
                <div class="">
                  <div class="border-5px p-20">
                    <h5><i class="fa fa-clock-o text-theme-colored"></i> Jadwal Praktek</h5>
                    <div class="opening-hours text-left">
                      <ul class="list-unstyled">
                        <?php
                          if ($jadwaldokter->kode == '200'){
                            foreach ($jadwaldokter->result as $res){
                              echo "<li class='clearfix line-height-1'> <span> ".$res->hari."</span>
                                    <div class='value'> ".$res->hourOffice."</div>
                                    </li>";
                            }
                          } else {
                            echo "<li class='clearfix line-height-1 text-center'>
                                  <small><em>Tidak ada jadwal praktek.</em></small>
                                  </li>";
                          }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 pl-20 pl-sm-15">
              <div>
                <h3 class="mt-0"><?= $detaildokter->result->person_nm; ?></h3>
                <h5 class="text-theme-colored"><?= $detaildokter->result->org_nm; ?></h5>
                <hr class="mb-0">
              </div>
              <div>
                <h5 class="mt-30 text-uppercase">Training Certifications & License</h5>

                <?php
                  if ($licensedokter->kode == '200'){
                    foreach ($licensedokter->result as $res){
                      echo "<p class='mb-0'><b><u>".$res->training_subject."</u></b></p>
                            <ul class='list theme-colored angle-double-right m-0 mb-20'>
                              <li class='mt-0 mb-0'><b>Nomor:</b> <span class='text-theme-colored'>".$res->training_serial."</span></li>
                              <li class='mt-0 mb-0'><b>Yang mengeluarkan:</b> <span class='text-theme-colored'>".$res->institution."</span></li>
                              <li class='mt-0 mb-0'><b>Masa berlaku:</b> <span class='text-theme-colored'>".$res->start_dttm." s/d ".$res->stop_dttm."</span></li>
                            </ul>";
                    }
                  } else {
                    echo "<small class='mt-20 ml-50'><em>Belum ada data yang ditambahkan.</em></small>";
                  } 
                ?>
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