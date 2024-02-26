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
    <section class="">
      <div class="container pb-0">
        <div class="row">
          <div class="col-md-12">
            <h3 class="text-gray mt-0 mt-sm-30 mb-0">Selamat Datang di</h3>
            <h2 class="text-dark mt-0">RSUD Palembang BARI</h2>
            <p class="font-weight-600">Kesembuhan Dan Kepuasan Pelanggan Adalah Kebahagian Kami</p>
            <p class="mt-20">Selamat Datang di Website Resmi RSUD Palembang BARI
Assalamu'alaikum Wr.Wb.
Puji Syukur kami panjatkan kehadirat Allah SWT karena atas berkat dan rahmatNya sehingga pelayanan informasi melalui media website dapat hadir sebagai wujud untuk pemenuhan keterbukaan informasi atas pelayanan kesehatan di RSUD Palembang BARI yang mengacu pada undang undang No.36 Tahun 2009 Tentang Kesehatan, BAB III tentang hak dan kewajiban, bagian kesatu, pasal 7; setiap orang berhak untuk mendapatkan informasi dan edukasi tentang kesehatan yang seimbang dan bertanggung jawab
Website RSUD Palembang BARI ini merupakan pusat informasi atas pelayanan kesehatan kepada masyarakat guna menjalin hubungan yang dinamis, inspiratif, transparan, dan komunikatif, yang terdiri dari fasilitas dan pelayanan kesehatan, penunjang medis, kerjasama pelayanan kesehatan, hingga profil serta data penunjang lainnya yang kami rangkum dari tahun ke tahun untuk memberikan gambaran secara umum tentang RSUD Palembang BARI
Melalui website ini kami berharap bisa lebih dekat lagi dengan masyarakat, sehingga dapat memberikan masukan kepada kami mengenai hal-hal apa saja yang perlu kami tingkatkan dalam mewujudkan pelayanan yang PRIMA di RSUD Palembang BARI
Peningkatan pelayanan kesehatan di RSUD Palembang BARI untuk menjadi Rumah Sakit pilihan masyarakat terus diupayakan sejalan dengan meningkatnya tuntutan masyarakat akan pelayanan yang optimal, bermutu, dan profesional. Sesuai dengan Motto Kesembuhan Dan Kepuasan Pelanggan Adalah Kebahagian Kami, maka kami terus berinovasi seiring terus melajunya perkembangan di dunia kesehatan saat ini agar tetap eksis dalam memenuhi kebutuhan pelanggan dibidang kesehatan
Demikian kata sambutan ini, besar harapan semoga hubungan kita yang sudah dekat bisa terjaga dan lebih dekat lagi di masa yang akan datang. Terimakasih, Salam Sehat dan Salam Bari
Wassalammu'alaikum Wr.Wb.</p>
            <p class="mt-20 mb-0"><img src="<?= base_url(); ?>/assets-front/images/sign_direktur.png"></p>
            <p class="mt-0 text-black">dr. Hj. Makiani, S.H.,M.M.,MARS</p>
            <br>
            <br>
          </div>
          <!-- 
          <div class="col-md-4">
            <img src="<?= base_url(); ?>/assets-front/images/about/direktur-crop.PNG"> 
          </div>
          -->
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>