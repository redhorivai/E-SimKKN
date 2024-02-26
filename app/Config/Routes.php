<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
// $routes->get('/instalasi-it', 'Instalasi_IT::index');
// $routes->get('/panel', 'Backend\Login::index');
// $routes->get('/panel/dashboard', 'Backend\Dashboard::index');
// $routes->get('/panel/slider', 'Backend\Slider::index');
// $routes->get('/panel/imut', 'Backend\Imut::index');
// $routes->get('/panel/standar-pelayanan', 'Backend\StandarPelayanan::index');
// $routes->get('/panel/layanan-unggulan', 'Backend\LayananUnggulan::index');
// $routes->get('/panel/informasi-dokter', 'Backend\Dokter::index');
// $routes->get('/panel/informasi-tarif', 'Backend\Tarif::index');
// $routes->get('/panel/artikel', 'Backend\Artikel::index');
// $routes->get('/panel/alur-pelayanan', 'Backend\AlurPelayanan::index');
// $routes->get('/panel/hak-kewajiban', 'Backend\HakKewajiban::index');
// $routes->get('/panel/tata-tertib', 'Backend\TataTertib::index');
// $routes->get('/panel/faq', 'Backend\FAQ::index');
// $routes->get('/panel/produk', 'Backend\Produk::index');
// $routes->get('/panel/changelog', 'Backend\Changelog::index');
// $routes->get('/panel/pengguna', 'Backend\Pengguna::index');
// $routes->get('/panel/lapor', 'Backend\Lapor::index');
// $routes->get('/panel/report-pengaduan', 'Backend\Lapor::report_lapor');
// $routes->get('/panel/item_fasilitas', 'Backend\Fasilitas::index');
// $routes->get('/panel/instansi', 'Backend\Instansi::index');
// $routes->get('/panel/mcu', 'Backend\Mcu::index');
// $routes->get('/syarat-ketentuan', 'Syarat::index');
// $routes->get('/kebijakan-privasi', 'Privasi::index');


$routes->get('/panel/slider', 'Backend\Slider::index');
// $routes->get('/', 'Backend\Dashboard::index');
$routes->get('/', 'Home::index');
$routes->get('/instalasi-it', 'Instalasi_IT::index');
$routes->get('/panel', 'Backend\Login::index');
$routes->get('/daftar', 'Backend\Daftar::index');
$routes->post('/Daftar/Upload', 'Backend\Daftar::Upload');
$routes->get('/panel/dashboard', 'Backend\Dashboard::index');
$routes->get('/panel/artikel', 'Backend\Artikel::index');
$routes->get('/panel/pengumuman', 'Backend\Pengumuman::index');
$routes->get('/panel/laporandpl', 'Backend\Laporandpl::index');
$routes->get('/panel/laporansurvei', 'Backend\Laporansurvei::index');
$routes->get('/panel/survei', 'Backend\Survei::index');
$routes->get('/panel/harian', 'Backend\Harian::index');
$routes->get('/panel/akhir', 'Backend\Akhir::index');
$routes->get('/panel/laporan-harian-mahasiswa', 'Backend\Laporanharian::report_harian');
$routes->get('/panel/rekap-nilai-mahasiswa', 'Backend\Laporanharian::rekap_nilai_mahasiswa');
// $routes->get('/panel/laporan-harian-mahasiswa/(:any)/(:any)', 'Backend\Laporanharian::view_report_2/$1/$2');
$routes->get('/panel/laporan-harian-mahasiswa', 'Backend\Laporanharian::index');
// $routes->get('/panel/rekap-nilai-harian-mahasiswa', 'Backend\RekapHarianNilaiMahasiswa::index');
$routes->get('/panel/laporan-akhir-mahasiswa', 'Backend\Laporanakhir::report_akhir');
$routes->get('/panel/pengguna', 'Backend\Pengguna::index');
$routes->get('/panel/lapor', 'Backend\Lapor::index');
$routes->get('/panel/report-pengaduan', 'Backend\Lapor::report_lapor');
$routes->get('/panel/instansi', 'Backend\Instansi::index');
$routes->get('/panel/profil', 'Backend\Profil::index');
$routes->get('/panel/gabung', 'Backend\Gabung::index');
$routes->get('/panel/fakultas', 'Backend\Fakultas::index');
$routes->get('/panel/prodi', 'Backend\Prodi::index');
$routes->get('/panel/periode', 'Backend\Periode::index');
$routes->get('/panel/kelompok', 'Backend\Kelompok::index');
$routes->get('/panel/aturkelompok', 'Backend\Aturkelompok::index');
$routes->get('/panel/kelompok_detail', 'Backend\Kelompok_detail::index');

// $routes->get('/detail_artikel/(:any)/(:num)', 'Informasi::detail_artikel/$1/$2');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
