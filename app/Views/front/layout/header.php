<header id="header" class="header">
    <!-- HEADER TOP -->
    <div class="header-top sm-text-center" style="border-bottom: 1px solid rgb(229,232,237);">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="widget no-border m-0">
            </div>
          </div>
          <div class="col-md-9">
            <div class="widget no-border m-0">
              <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">
                <?php 
                  foreach($dataInstansi as $key){
                    echo "<li class='m-0 pl-10 pr-10' style='color: #5b6987 !important;'> 
                            <small><i class='fa fa-phone'></i> <b>085273083460</b></small> 
                          </li>
                          <li class='m-0 pl-10 pr-10' style='color: #5b6987 !important;'> 
                            <small><i class='fa fa-envelope-o'></i> <b>simkkn.sribertech.com
                            </b></small> 
                          </li>";
                  } 
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- HEADER MENU -->
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-lightest" style="box-shadow: 0 4px 32px 0 rgba(10,14,29,.02),0 8px 64px 0 rgba(10,14,29,.08);">
        <div class="container">
          <nav id="menuzord-right" class="menuzord red bg-lightest">
            <a class="menuzord-brand pull-left flip" href="<?= base_url('/'); ?>">
              <img src="<?= base_url() ?>/assets-admin/panel/images/logo/simkkn_logopolos.png" style="max-width:200px;max-height:100px;">
            </a>
            <!-- MENU -->
            <ul class="menuzord-menu">
              <li class="<?php if ($menu == 'home') { echo 'active'; } ?>">
                <?php if ($menu == 'home') {
                  echo "<a href='#home'>Beranda</a>";
                } else {
                  echo "<a href='".base_url('/')."'>Beranda</a>";
                } 
                ?>
              </li>
              <li class="<?php if ($menu == 'profil') { echo 'active'; } ?>">
                <a href="javascript:void(0)">Profil</a>
                <ul class="dropdown">
                  <li><a href="<?= base_url('/profil/tentangkami'); ?>">Tentang Kami</a></li>
                  <!-- <li><a href="<?= base_url('/profil/visimisi'); ?>">Visi dan Misi</a></li> -->
                  <!-- <li><a href="<?= base_url('/profil/tatanilai'); ?>">Tata Nilai dan Motto</a></li> -->
                  <!-- <li><a href="<?= base_url('/profil/direksi'); ?>">Direksi</a></li> -->
                  <!-- <li><a href="javascript:void(0)">Indikator Mutu</a>
                    <ul class="dropdown">
                      <li><a href="<?= base_url('/profil/grafik_hais'); ?>">Insiden Rate HAIs</a></li>
                      <li><a href="<?= base_url('/profil/grafik_ikm'); ?>">Indeks Kepuasan Masyarakat (IKM)</a></li>
                      <li><a href="<?= base_url('/profil/grafik_skm'); ?>">Survei Kepuasan Masyarakat (SKM)</a></li>
                    </ul>
                  </li> -->
                </ul>
              </li>
              <!-- <li class="<?php if ($menu == 'pelayanan') { echo 'active'; } ?>">
                <a href="javascript:void(0)">Pelayanan</a>
                <ul class="dropdown">
                  <li><a href="<?= base_url('/pelayanan/standar_pelayanan'); ?>">Standar Pelayanan</a></li>
                  <li><a href="<?= base_url('/pelayanan/layanan_unggulan'); ?>">Layanan Unggulan</a></li>
                  <li><a href="<?= base_url('/pelayanan/layanan_pengaduan'); ?>">Layanan Pengaduan</a></li>
                </ul>
              </li> -->
              <li class="<?php if ($menu == 'informasi') { echo 'active'; } ?>">
                <a href="javascript:void(0)">Informasi</a>
                <ul class="dropdown">
                  <!-- <li><a href="<?= base_url('/informasi/covid'); ?>">Covid-19</a></li> -->
                  <!-- <li><a href="<?= base_url('/informasi/poli'); ?>">Dokter</a></li> -->
                  <!-- <li><a href="<?= base_url('/informasi/bed'); ?>">Ketersediaan Tempat Tidur</a></li> -->
                  <!-- <li><a href="<?= base_url('/informasi/tarif'); ?>">Tarif</a></li> -->
                  <li><a href="<?= base_url('/informasi/artikel'); ?>">Artikel / Berita</a></li>
                  <li><a href="<?= base_url('/informasi/pengumuman'); ?>">Pengumuman</a></li>
                </ul>
              </li>
              <!-- <li class="<?php if ($menu == 'pasien') { echo 'active'; } ?>">
                <a href="javascript:void(0)">Pasien & Pengunjung</a>
                <ul class="dropdown">
                  <li><a href="<?= base_url('/pasien/alur_pelayanan'); ?>">Alur Pelayanan</a></li>
                  <li><a href="<?= base_url('/pasien/tata_tertib'); ?>">Tata Tertib</a></li>
                  <li><a href="<?= base_url('/pasien/hak_kewajiban'); ?>">Hak dan Kewajiban Pasien</a></li>
                  <li><a href="<?= base_url('/pasien/pendaftaran_online'); ?>">Pendaftaran Online</a></li>
                  <li><a href="<?= base_url('/pasien/faq'); ?>">Frequently Ask Question (FAQ)</a></li>
                  <li><a href="<?= base_url('/pasien/kuisioner'); ?>">Survei Kepuasan Masyarakat (SKM)</a></li>
                </ul>
              </li> -->
              <!-- <li class="<?php if ($menu == 'produk') { echo 'active'; } ?>">
                <a href="javascript:void(0)">Produk</a>
                <ul class="dropdown">
                  <li><a href="<?= base_url('/produk/apm'); ?>">Anjungan Pendaftaran Mandiri (APM)</a></li>
                  <li><a href="<?= base_url('/produk/bari_mobile'); ?>">BARI Mobile</a></li>
                </ul>
              </li> -->
              <!-- <li class="<?php if ($menu == 'kontak') { echo 'active'; } ?>">
                <a href="<?= base_url('/kontak'); ?>">Kontak</a>
              </li> -->
            </ul>
            <!-- END MENU -->
          </nav>
        </div>
      </div>
    </div>
</header>
