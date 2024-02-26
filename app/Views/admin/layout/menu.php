<!-- MENU -->
<div class="br-logo" style="justify-content:center;">
    <a href="<?= base_url('panel/dashboard') ?>">
        <img src="<?= base_url() ?>/assets-admin/panel/images/logo/simkkn_logopolos.png" style="max-width:200px;max-height:52px;">
        <!-- <span>[</span>LOGO <i>APLIKASI</i><span>]</span> -->
    </a>
</div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3"><b>Menu Navigasi</b></label>
    <ul class="sidebar-menu">
      <li class="<?php if ($active == "dashboard") {echo "active";} ?>">
        <a href="<?= base_url('panel/dashboard') ?>">
          <i class="fa fa-home tx-16"></i> <span>Dashboard</span>
        </a>
      </li>


     
      <?php if (session()->get('level') == 'Super User') { ?>
      <li class="<?php if ($active == "artikel" || $active == "pengumuman" ) { echo "active";} ?>">
        <a href="javascript:void(0)">
          <i class="fa fa-book"></i> <span>Konten</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "artikel") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/artikel') ?>">- Artikel / Berita</a>
          </li>
          <li class="<?php if ($active == "pengumuman") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/pengumuman') ?>">- Pengumuman</a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <?php if (session()->get('level') == 'Super User') { ?>
      <li class="<?php if ($active == "pengguna" || $active == "prodi" || $active == "periode" || $active == "kelompok" || $active == "aturkelompok" || $active == "kelompok_detail") { echo "active";} ?>">
        <a href="javascript:void(0)">
        <i class="fa fa-folder"></i> <span>Data Master</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "pengguna") {echo "active";} ?>">
            <a href="<?= base_url('panel/pengguna') ?>">
              <span>- Pengguna</span>
            </a>
          </li>
          <li class="<?php if ($active == "prodi") {echo "active";} ?>">
            <a href="<?= base_url('panel/prodi')?>">
              <span>- Program Studi</span>
            </a>
          </li>
          <li class="<?php if ($active == "periode") {echo "active";} ?>">
            <a href="<?= base_url('panel/periode') ?>">
              <span>- Periode</span>
            </a>
          </li>
          <li class="<?php if ($active == "kelompok") {echo "active";} ?>">
            <a href="<?= base_url('panel/kelompok') ?>">
              <span>- Kelompok</span>
            </a>
          </li>
          <li class="<?php if ($active == "aturkelompok") {echo "active";} ?>">
            <a href="<?= base_url('panel/aturkelompok') ?>">
              <span>- Atur Kelompok</span>
            </a>
          </li>
          <li class="<?php if ($active == "kelompok_detail") {echo "active";} ?>">
            <a href="<?= base_url('panel/kelompok_detail') ?>">
              <span>- Detail Kelompok</span>
            </a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <?php if (session()->get('level') != 'User') { ?>
      <li class="<?php if ($active == "laporandpl" || $active == "laporansurvei" || $active == "laporanharian" || $active == "laporanakhir") { echo "active";} ?>">
        <a href="javascript:void(0)">
          <i class="fa fa-user"></i> <span>Dosen</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "laporandpl") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/laporandpl') ?>">- Surat Tugas</a>
          </li>
          <li class="<?php if ($active == "laporansurvei") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/laporansurvei') ?>">- Laporan Kegiatan Survei</a>
          </li>
          <li class="<?php if ($active == "laporanharian") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/laporan-harian-mahasiswa') ?>">- Laporan Kegiatan harian</a>
          </li>
          <li class="<?php if ($active == "laporanakhir") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/laporan-akhir-mahasiswa') ?>">- Laporan Kegiatan Akhir</a>
          </li>
          <!-- <li class="<?php if ($active == "rekapnilaiharianmahasiswa") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/rekap-nilai-harian-mahasiswa') ?>">- Rekap Nilai Harian</a>
          </li> -->
          <li class="">
                <a href="javascript:void(0)') ?>">- Pengaduan</a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <?php if (session()->get('level') != 'Admin') { ?>
      <li class="<?php if ($active == "survei" || $active == "harian" || $active == "akhir" || $active == "pengaduan") { echo "active";} ?>">
        <a href="javascript:void(0)">
          <i class="fa fa-users"></i> <span>Mahasiswa</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "survei") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/survei') ?>">- Survei <span class="ms-2 badge badge-soft-success rounded-pill" style="color: #fff;"> Ketua</span></a>
          </li>
          <li class="<?php if ($active == "harian") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/harian') ?>">- Laporan harian</a>
          </li>
          <li class="<?php if ($active == "akhir") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/akhir') ?>">- Laporan Akhir <span class="ms-2 badge badge-soft-success rounded-pill" style="color: #fff;"> Ketua</span></a>
          </li>
          <li class="">
                <a href="javascript:void(0)') ?>">- Pengaduan</a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <?php if (session()->get('level') == 'Super User') { ?>
      <li class="<?php if ($active == "reportlapor") { echo "active";} ?>">
      <label class="sidebar-label pd-x-10 mg-t-20 op-3"><b>Menu Rekapitulasi</b></label>  
        <a href="<?= base_url('panel/report-pengaduan') ?>">
          <i class="fa fa-comments"></i> <span>Rekap Pengaduan</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0)">
          <i class="fa fa-sticky-note-o"></i> <span>Rekap Nilai</span>
        </a>
      </li>
      <?php } ?>

      <?php if (session()->get('level') == 'Super User') { ?>
    <label class="sidebar-label pd-x-10 mg-t-20 op-3"><b>Menu Konfigurasi</b></label>
      <li class="<?php if ($active == "instansi") { echo "active";} ?>">
        <a href="javascript:void(0)">
        <i class="fa fa-cog"></i> <span>Pengaturan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "instansi") {echo "active";} ?>">
            <a href="<?= base_url('panel/instansi') ?>">
              <span>- Instansi</span>
            </a>
          </li>          
        </ul>
      </li>
      <?php } ?>
    </ul>
</div>
<!-- END MENU -->