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
              <li><a href="javascript:void(0)">Produk</a></li>
              <li class="active text-theme-colored"><?= $title; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTENT -->
  <section>
    <div class="container pt-20">
      <div class="section-content">
        <div class="row">
          <div class="col-md-12">
            <div class="service-content mt-50 ml-20 ml-sm-0">
              <ul id="myTab" class="nav nav-tabs boot-tabs">
                <li class="active" style="width: 50%;">
                  <a href="#release" data-toggle="tab">RELEASE</a>
                </li>
                <li style="width: 50%;">
                  <a href="#roadmap" data-toggle="tab">ROADMAP</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class='tab-pane fade in active' id='release'>
                  <?= $tab_release; ?>
                </div>
                <div class='tab-pane fade' id='roadmap'>
                  <?= $tab_roadmap; ?>
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