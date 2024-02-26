<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Backend\LayananModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\PengaduanModel;
use App\Models\Backend\PenggunaModel;
use App\Models\Backend\InstansiModel;
use App\Libraries\Date\DateFunction;
use App\Models\Backend\PengumumanModel;

class Informasi extends BaseController
{
    protected $m_layanan;
    protected $m_artikel;
    protected $m_pengumuman;
    protected $m_pengguna;
    protected $m_instansi;
    protected $session;
    public function __construct()
    {
        $this->m_layanan  = new LayananModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_pengumuman  = new PengumumanModel();
        $this->m_pengguna = new PenggunaModel();
        $this->m_instansi = new InstansiModel();
        $this->date       = new DateFunction();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }

    function xrequestAPI($url)
    {
        $session = curl_init($url);
        $arrheader =  array(
            'Content-Type:application/json',
        );
        curl_setopt($session, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($session, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');
        $response = curl_exec($session);
        return $response;
    }
    function xpostrequestAPI($url, $datapost)
    {
        $arrheader =  array(
            'Accept: application/json',
            'Content-Type: Application/x-www-form-urlencoded'
        );

        $session = curl_init($url);
        curl_setopt($session, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($session, CURLOPT_POST, 1);
        curl_setopt($session, CURLOPT_POSTFIELDS, implode($datapost));
        curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($session, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');
        $response = curl_exec($session);
        return $response;
    }

    public function index()
    {
        $datapoli = $this->getPoli();
        $data = [
            'title'         => 'Dokter',
            'menu'          => 'informasi',
            'datapoli'      => $datapoli,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/poli', $data);
    }
    public function covid()
    {
        $data = [
            'title'         => 'Covid-19',
            'menu'          => 'informasi',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/covid', $data); 
    }
    public function poli()
    {
        $datapoli = $this->getPoli();
        $data = [
            'title'         => 'Dokter',
            'menu'          => 'informasi',
            'datapoli'      => $datapoli,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/poli', $data);
    }

    public function dokter_poli()
    {
        $org_id = $this->request->uri->getSegment(3);
        $dokterpoli = $this->getDokter($org_id);
        $data = [
            'title'         => 'Dokter',
            'menu'          => 'informasi',
            'dokterpoli'    => $dokterpoli,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/dokter_poli', $data);
        // return $this->response->setJSON($dokterpoli->result);
    }

    public function profil_dokter()
    {
        $person_id     = $this->request->uri->getSegment(3);
        $detaildokter  = $this->getDetailDokter($person_id, 'detail');
        $licensedokter = $this->getDetailDokter($person_id, 'license');
        if ($detaildokter->kode == '200') {
            $jadwaldokter = $this->getDetailDokter($person_id, 'jadwal');
        }
        $data = [
            'title'         => 'Profil Dokter',
            'menu'          => 'informasi',
            'detaildokter'  => $detaildokter,
            'jadwaldokter'  => $jadwaldokter,
            'licensedokter' => $licensedokter,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/profil-dokter', $data);
        // return $this->response->setJSON($detaildokter);
    }
    public function tarif()
    {
        $kategori_tarif = $this->m_layanan->getCategoryTarif();
        $kat_tarif = "";
        $det_tarif = "";
        foreach ($kategori_tarif as $res) {
            if ($res->kategory == "Ranap") {
                $tarif_nm = "Tarif Rawat Inap";
                $class_li = "active";
                $class_tab = "in active";
            } else if ($res->kategory == "Rajal") {
                $tarif_nm = "Tarif Rawat Jalan";
                $class_li = "";
                $class_tab = "";
            } else if ($res->kategory == "Visit") {
                $tarif_nm = "Tarif Visit Dokter Spesialis";
                $class_li = "";
                $class_tab = "";
            } else if ($res->kategory == "MCU") {
                $tarif_nm = "Tarif Medical Check-Up";
                $class_li = "";
                $class_tab = "";
            } else if ($res->kategory == "PCR") {
                $tarif_nm = "Tarif Tes PCR";
                $class_li = "";
                $class_tab = "";
            } else {
                $tarif_nm = "Tarif Tes SWAB Antigen";
                $class_li = "";
                $class_tab = "";
            }

            $kat_tarif .= "<li class='".$class_li."'>
                           <a href='#".$res->kategory."' data-toggle='tab' style='font-size: 16px !important;padding: 12px 0 12px 0;'>
                           ".$tarif_nm."
                           </a>
                           </li>";
            
            $det_tarif .= "<div class='tab-pane fade ".$class_tab."' id='".$res->kategory."'>
                           <div class='row'>
                           <div class='col-md-12'>
                           <h3 class='title mb-30 line-bottom' style='margin-top: 0 !important;'>".$tarif_nm."</h3>";
            $fasilitas = $this->m_layanan->getLayananByKategori($res->kategory);
            foreach ($fasilitas as $key) {
                $det_tarif .= "<ul class='list-border-bottom no-padding'>
                               <li class='mb-20'>
                               <h5 class='mb-0' class='mb-0'> ".$key->nama."
                               <span class='pull-right flip font-weight-400 pr-20'>Rp. ".$key->harga." 
                               <small>".$key->satuan."</small>
                               </span>
                               </h5>
                               <p class='mb-0'>".$key->deskripsi."</p>
                               <ul class='list theme-colored angle-double-right mt-0'>";
                $itemFasilitas = $this->m_layanan->getItemByNama($key->nama);
                foreach ($itemFasilitas as $item) {
                    $det_tarif .= "<li class='mt-0 mb-0'>".$item->item_fasilitas_nm."</li>";
                }
                $det_tarif .= "</ul>
                               </li>
                               </ul>";
            }
            $det_tarif .= "</div></div></div>";
        }
        $data = [
            'title'         => 'Tarif',
            'menu'          => 'informasi',
            'kat_tarif'     => $kat_tarif,
            'det_tarif'     => $det_tarif,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/tarif', $data);
    }
    public function artikel()
    {
        $artikel = $this->m_artikel->getArtikel();
        $resContent = "";
        if (count($artikel)) {
            foreach ($artikel as $res) {
                $user = $this->m_pengguna->getByID($res->created_user);
                foreach ($user as $data) {
                    $level = $data->level;
                    if($level == "Super User"){
                        $nama = "Admin";
                    } else {
                        $nama = "Humas RSUD Palembang BARI";
                    }
                }
                $jmlStrTitle = strlen($res->title);
                if ($jmlStrTitle >= 21) {
                    $titleStr = substr($res->title, 0, 21);
                    $title = $titleStr . '...';
                } else {
                    $title = $res->title;
                }
                $jmlStrDesc = strlen($res->description);
                if ($jmlStrDesc >= 88) {
                    $descStr = substr($res->description, 0, 88);
                    $description = $descStr . '...';
                } else {
                    $description = $res->description;
                }
                if ($res->type == 'artikel'){ 
                    $resContent .= "<div class='col-sm-6 col-md-3 col-lg-3'>
                                    <article class='post clearfix maxwidth600 mb-30'>
                                    <div class='entry-header'>
                                    <div class='post-thumb thumb'> 
                                    <img src='".base_url()."/image/artikel/".$res->thumbnail_nm."' class='img-responsive img-fullwidth'> 
                                    </div>
                                    </div>
                                    <div class='entry-content border-1px p-20'>
                                    <h5 class='entry-title mt-0 pt-0'>
                                    <a href='" . base_url('/informasi/detail_artikel/' . $res->artikel_id . '') . "'>
                                    ".$title."
                                    </a>
                                    </h5>
                                    <ul class='list-inline entry-date font-12 mt-5'>
                                    <li class='pr-0'>
                                    <small class='text-theme-colored' href='javascript:void(0)'>".$nama." | " . $this->date->panjang($res->created_dttm) . "</small>
                                    </li>
                                    </ul>
                                    <p class='text-left mb-20 mt-15 font-13'>" . $description . "</p>
                                    <a href='" . base_url('/informasi/detail_artikel/' . $res->artikel_id . '') . "' class='btn btn-dark btn-theme-colored btn-xs btn-flat mt-0'>Selengkapnya</a>
                                    <div class='clearfix'></div>
                                    </div>
                                    </article>
                                    </div>";
                }
            }
        } else {
            $resContent .= "<h5 class='text-center' style='padding-bottom:30px;'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Artikel / Berita',
            'menu'          => 'informasi',
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/artikel', $data);
    }
    public function pengumuman()
    {
        $pengumuman = $this->m_pengumuman->getPengumuman();
        $resContent = "";
        if (count($pengumuman)) {
            foreach ($pengumuman as $res) {
                $user = $this->m_pengguna->getByID($res->created_user);
                foreach ($user as $data) {
                    $level = $data->level;
                    if($level == "Super User"){
                        $nama = "Admin";
                    } else {
                        $nama = "Humas RSUD Palembang BARI";
                    }
                }
                $resContent .= "<div class='col-sm-6 col-md-3 col-lg-3'>
                <article class='post clearfix maxwidth600 mb-30'>
                <div class='entry-header'>
                <div class='post-thumb thumb'> 
                <img src='".base_url()."/assets-front/images/icon-pdf.png' style='max-width:50px;' class='img-responsive img-fullwidth'> 
                </div>
                </div>
                <div class='entry-content border-1px p-20'>
                <h5 class='entry-title mt-0 pt-0'>
                <a href='" . base_url('/informasi/detail_pengumuman/' . $res->id . '') . "'>
                ".$res->judul."
                </a>
                </h5>
                <ul class='list-inline entry-date font-12 mt-5'>
                <li class='pr-0'>
                <small class='text-theme-colored' href='javascript:void(0)'>".$nama." | " . $this->date->panjang($res->created_dttm) . "</small>
                </li>
                </ul>
                <p class='text-left mb-20 mt-15 font-13'>" . $res->judul . "</p>
                <a href='" . base_url('/assets-admin/panel/document/' . $res->path . '') . "' target='_blank' class='btn btn-dark btn-theme-colored btn-xs btn-flat mt-0'>Download</a>
                <div class='clearfix'></div>
                </div>
                </article>
                </div>";
            }
        } else {
            $resContent .= "<h5 class='text-center' style='padding-bottom:30px;'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Pengumuman',
            'menu'          => 'informasi',
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/pengumuman', $data);
    }
    public function detail_artikel($id)
    {
        $detail = $this->m_artikel->getByID($id);
        $resDetail = "";
        foreach ($detail as $res) {
            $user = $this->m_pengguna->getByID($res->created_user);
            foreach ($user as $data) {
                $level = $data->level;
                if($level == "Super User"){
                    $nama = "Admin";
                } else {
                    $nama = "Humas RSUD Palembang BARI";
                }
            }
            if (!empty($res->thumbnail_nm)) {
                $banner = "<img src='" . base_url() . "/image/artikel/" . $res->thumbnail_nm . "' class='img-responsive img-fullwidth'>";
            } else {
                $banner = "<img src='" . base_url() . "/image/thumbnail/800x600.png' class='img-responsive img-fullwidth'>";
            }
            
            $tgl = date('d', strtotime($res->created_dttm));
            $bln = date('M', strtotime($res->created_dttm));
            $g = array("",$res->banner_nm,$res->banner_nm2,$res->banner_nm3,$res->banner_nm4,$res->banner_nm5,$res->banner_nm6);
            
            $resDetail .= "
            <div class='col-md-9'>
                <div class='blog-posts single-post'>
                    <article class='post clearfix mb-0' style='border-bottom:none !important;'>
                        <div class='entry-header'>
                        <div class='post-thumb thumb'>";
                        for ($i = 1; $i <= 6; $i++) {
                            if ($g[$i] != "800x600.png"){
                            $resDetail .= "<div class='mySlides'>
                                           <div class='numbertext'>".$i." / 6</div>
                                           <img src='".base_url()."/image/artikel/".$g[$i]."' style='width:100%'>
                                           </div>";
                            }
                        }            
            $resDetail .= "
                      <a class='prev' onclick='plusSlides(-1)'>❮</a>
                      <a class='next' onclick='plusSlides(1)'>❯</a>
                    
                      <div class='caption-container'>
                        <p style='margin-bottom:0 !important;padding-top:5px;padding-bottom:5px;' id='caption'></p>
                      </div>";
                      
                      for ($i = 1; $i <= 6; $i++) {
                        if ($g[$i] != "800x600.png"){
                        $resDetail .= "<div class='column'>
                                       <img class='demo cursor' src='".base_url()."/image/artikel/".$g[$i]."' style='width:100%;' onclick='currentSlide(".$i.")' alt='RSUD Palembang BARI'>
                                       </div>";
                        }
                      }
            $resDetail .= "            
                        </div>
                        </div>
                        <div class='entry-content'>
                        <div class='entry-meta media no-bg no-border mt-15 pb-20'>
                            <div class='entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15'>
                            <ul>
                                <li class='font-16 text-white font-weight-600'>".$tgl."</li>
                                <li class='font-12 text-white text-uppercase'>".$bln."</li>
                            </ul>
                            </div>
                            <div class='media-body pl-15'>
                            <div class='event-content pull-left flip'>
                                <h3 class='entry-title text-dark text-uppercase pt-0 mt-0'>
                                " . $res->title . "
                                </h3>
                                <span class='mb-10 text-gray-darkgray mr-10 font-13'>
                                <i class='fa fa-pencil mr-5 text-theme-colored'></i> 
                                Diposting oleh ".$nama."</span>
                            </div>
                            </div>
                        </div>
                        <p class='mb-15'>" . $res->description . "</p>
                        </div>
                    </article>
                </div>
            </div>";
        }
        $data = [
            'title'         => 'Detail Artikel',
            'menu'          => 'informasi',
            'resDetail'     => $resDetail,
            'latestNews'    => $this->m_artikel->getLimit('8'),
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/detail_artikel', $data);
    }
    public function getPoli()
    {
        $completeurl = "https://simars.cliniccoding.id/apiAppsBari/index.php/Dokter/getPoli";
        $response = $this->xrequestAPI($completeurl);
        $sml = json_decode($response);
        return $sml->result;
    }
    public function getDokter($org_id)
    {
        $datapost = array(
            "org_id=$org_id",
        );
        $completeurl = "https://simars.cliniccoding.id/apiAppsBari/index.php/Dokter/getDokterByPoli"; // web services #1
        $response = $this->xpostrequestAPI($completeurl, $datapost);
        $sml = json_decode($response);
        // return $this->response->setJSON($sml);
        return $sml;
    }
    public function getDetailDokter($person_id, $param)
    {
        $datapost = array(
            "person_id=$person_id",
        );
        if ($param == 'detail') {
            $fungsi = 'getDetailDokter';
        } else if ($param == 'jadwal') {
            $fungsi = 'getJadwalDokter';
        } else {
            $fungsi = 'getTrainingLicense';
        }
        $completeurl = "https://simars.cliniccoding.id/apiAppsBari/index.php/Dokter/" . $fungsi . ""; // web services #1
        $response = $this->xpostrequestAPI($completeurl, $datapost);
        $sml = json_decode($response);
        // return $this->response->setJSON($sml);
        return $sml;
    }
    public function bed()
    {
        $databed = $this->getBedSimrs();
        $data = [
            'title'         => 'Ketersediaan Tempat Tidur',
            'menu'          => 'informasi',
            'databed'       => $databed,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/bed', $data);
    }
    public function getBedSimrs()
    {
        $completeurl = "https://simars.cliniccoding.id/apiAppsBari/index.php/BedMonitoring/getBedMonitoring";
        $response = $this->xrequestAPI($completeurl);
        $sml = json_decode($response);
        // return $this->response->setJSON($sml);
        return $sml->result;
    }
}
