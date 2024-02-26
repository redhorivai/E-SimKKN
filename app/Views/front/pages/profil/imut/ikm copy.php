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
            <?php foreach($chart as $key): ?>
            <div class="col-sm-6 col-md-6">                            
              <div class="heading-line-bottom" style="display: block;">
                <h4 class="text-center">
                  <?= $key->chart_nm; ?><br>
                  <?= $key->chart_periode; ?>
                </h4>
              </div>
              <div style="width: 90%" class="text-center">
                <canvas id="chart_<?= $key->chart_id; ?>" width="500" height="500"></canvas>
              </div>
            </div>
            <?php endforeach ?>
            <!-- END GRAFIK -->
            
          </div>
        </div>
      </div>
    </section>

    <div class="clear"></div>
    <script type="text/javascript">
      window.onload = function(){

        
        <?php
         foreach ($chartIndicator as $key) {
            $label[] = $key->indicator_nm;
            $nilai[] = $key->indicator_value;
         }
        ?>
        var ctx = document.getElementById("chart_<?= $key->chart_id; ?>").getContext("2d");
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels   : <?= json_encode($label); ?>,
            datasets : [{
              label  : '',
              data   : <?= json_encode($nilai); ?>,
              backgroundColor: [
              'rgba(255,0,0)',
              'rgb(255,69,0)',
              'rgba(255,255,0)',
              'rgb(50,205,50)',
              'rgb(72,209,204)',
              'rgb(70,130,180)',
              'rgb(25,25,112)',
              'rgb(75,0,130)',
              'rgb(128,0,128)',
              ],
            }]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero:true
                }
              }]
            }
          }
        });
       
                
        
      };
    </script>
    <!-- JS | Chart-->
    <script src="<?= base_url(); ?>/assets-front/js/Chart.js"></script>
    
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>