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
          <div class="row mb-50">
            <!-- GRAFIK -->
            
            <!-- END GRAFIK -->
          </div>
        </div>
      </div>
    </section>

    <div class="clear"></div>
    <script type='text/javascript'>
      var randomScalingFactor = function(){ return Math.round(Math.random()*10)};
      var lineChartData = {
        labels : ['Januari','Februari','Maret'],
        datasets : [
          {
            label: 'Data 1',
            fillColor : 'rgba(220,220,220,0.2)',
            strokeColor : 'rgba(220,220,220,1)',
            pointColor : 'rgba(220,220,220,1)',
            pointStrokeColor : '#fff',
            pointHighlightFill : '#fff',
            pointHighlightStroke : 'rgba(220,220,220,1)',
            data : [1.68,1.49,1.72]
          },
          {
            label: 'Data 2',
            fillColor : 'rgba(151,187,205,0.2)',
            strokeColor : 'rgba(151,187,205,1)',
            pointColor : 'rgba(151,187,205,1)',
            pointStrokeColor : '#FFF',
            pointHighlightFill : '#FFF',
            pointHighlightStroke : 'rgba(151,187,205,1)',
            data : [0,0,0]
          }
        ]
      };
      window.onload = function(){
        var chart_lineChart = document.getElementById('lineChartHAIs').getContext('2d');
        window.myLine = new Chart(chart_lineChart).Line(lineChartData, {
          responsive: true
        });
      }
    </script>
    <!-- JS | Chart-->
    <script src="<?= base_url(); ?>/assets-front/js/chart.js"></script>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>