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
            <?= $grafik; ?>
            <!-- <select class="dropdown form-control" id="dd">
                <option value="SEMESTER I" selected="selected">PILIH PERIODE</option>
                <option value="SEMESTER I">SEMESTER I</option>
                <option value="SEMESTER II">SEMESTER II</option>
            </select>
            <br>
            <div id="chartContainer1" style="height: 360px; width: 100%;"></div> -->
            <!-- <div id="chartContainer1" style="width: 45%; height: 300px;display: inline-block;"></div> 
            <div id="chartContainer2" style="width: 45%; height: 300px;display: inline-block;"></div><br><br>
            <div id="chartContainer3" style="width: 45%; height: 300px;display: inline-block;"></div>
            <div id="chartContainer4" style="width: 45%; height: 300px;display: inline-block;"></div> -->
            <!-- END GRAFIK -->
          </div>
        </div>
      </div>
    </section>

    <div class="clear"></div>

    <script>
    window.onload = function () { 
     <?= $script; ?>
    // var jsonData = {
    //     "SEMESTER I":[
    //         {y: 3320, label: "Persyaratan"},
    //         {y: 3327, label: "Prosedur"},
    //         {y: 3333, label: "Waktu Pelayanan"},
    //         {y: 3200, label: "Biaya/Tarif"},
    //         {y: 3300, label: "Produk Layanan"},
    //         {y: 3460, label: "Kompetensi Pelaksana"},
    //         {y: 3367, label: "Perilaku Pelaksana"},
    //         {y: 3680, label: "Penanganan Pengaduan"},
    //         {y: 3627, label: "Ketersediaan Sarana & Prasarana"},
    //     ],

    //     "SEMESTER II":[
    //         {y: 111, label: "AAA"},
    //         {y: 222, label: "BBB"},
    //         {y: 333, label: "CCC"},
    //         {y: 444, label: "DDD"},
    //     ],
    // }

    //     var dataPoints = [];
    //     var chart = new CanvasJS.Chart("chartContainer1",
    //     {
    //     animationEnabled: true,
    //         axisX: {
    //         interval: 1
    //     },
    //     axisY:{
    //             // interlacedColor: "rgba(1,77,101,.2)",
    //             gridColor: "rgba(1,77,101,.1)",
    //             title: 'Value (Nilai)',
    //             includeZero: true,
    //     },

    //         data: [{
    //         type: 'column',
    //         // color: "#014D65",
    //         //xValueFormatString:"D MM h:mm",
    //         name: "series1",
    //         dataPoints: dataPoints // this should contain only specific serial number data

    //         }]
    //     });

    //     $( ".dropdown" ).change(function() {
    //         chart.options.data[0].dataPoints = [];
    //     var e = document.getElementById("dd");
    //         var selected = e.options[e.selectedIndex].value;
    //     dps = jsonData[selected];
    //     for(var i in dps) {
    //         chart.options.data[0].dataPoints.push({label: dps[i].label, y: dps[i].y});
    //     }
    //     chart.render();
    //     })

    }
    </script>
    
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>