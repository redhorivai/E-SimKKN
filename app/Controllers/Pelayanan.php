<?php

namespace App\Controllers;
use App\Models\Backend\InfoModel;
use App\Models\Backend\LayananModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\InstansiModel;

class Pelayanan extends BaseController
{
    protected $m_info;
    protected $m_layanan;
    protected $m_artikel;
    protected $m_instansi;
    protected $session;
    public function __construct()
    {
        $this->m_info     = new InfoModel();
        $this->m_layanan  = new LayananModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_instansi = new InstansiModel();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $data = [
            'title'         => 'Standar Pelayanan',
            'menu'          => 'pelayanan',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pelayanan/standar-pelayanan', $data);
    }
    public function standar_pelayanan()
    {
        $data1 = $this->m_info->getByTypeLimit('standar_pelayanan', 1);
        $data2 = $this->m_info->getByTypeLimit('standar_pelayanan', 0);
        $ret = "";
        if (count($data1) > 0){
        $ret .= "<div class='col-md-12'>
                 <div class='service-content ml-20 ml-sm-0'>
                 <h2 class='title mt-0'>Standar Pelayanan Rumah Sakit</h2>";
        foreach ($data1 as $res1){
            $ret .= "<p>".$res1->info_desc."</p>";
        }
            $ret .= "<div class='row mt-30 mb-20'>";
            foreach ($data2 as $res2){
                $ret .= "<div class='col-sm-4 col-md-4'>
                         <ul class='list theme-colored mt-0'>
                         <li class='mb-0'>
                         <a href='".$res2->info_link."' target='_blank'>".$res2->info_title."</a>
                         </li>
                         </ul>
                         </div>";
            }
            $ret .= "</div>";         
        $ret .= "</div>
                 </div>";
        } else {
            $ret .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Standar Pelayanan',
            'menu'          => 'pelayanan',
            'resLayanan'    => $ret,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pelayanan/standar-pelayanan', $data);
    }
    public function manufacturing()
    {
        $data1 = $this->m_info->getByTypeLimit('manufacturing', 1);
        $data2 = $this->m_info->getByTypeLimit('manufacturing', 0);
        $ret = "";
        if (count($data1) > 0){
        $ret .= "<div class='col-md-12'>
                 <div class='service-content ml-20 ml-sm-0'>
                 <h2 class='title mt-0'>Standar Pelayanan Terkait Dengan Proses Pelaksana (Manufacturing)</h2>";
        foreach ($data1 as $res1){
            $ret .= "<p>".$res1->info_desc."</p>";
        }
            $ret .= "<div class='row mt-30 mb-20'>";
            foreach ($data2 as $res2){
                $ret .= "<div class='col-sm-4 col-md-4'>
                         <ul class='list theme-colored mt-0'>
                         <li class='mb-0'>
                         <a href='".$res2->info_link."' target='_blank'>".$res2->info_title."</a>
                         </li>
                         </ul>
                         </div>";
            }
            $ret .= "</div>";         
        $ret .= "</div>
                 </div>";
        } else {
            $ret .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Pelaksana (Manufacturing)',
            'menu'          => 'pelayanan',
            'resLayanan'    => $ret,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pelayanan/manufacturing', $data);
    }
    public function service_point()
    {
        $data1 = $this->m_info->getByTypeLimit('service_point', 1);
        $data2 = $this->m_info->getByTypeLimit('service_point', 0);
        $ret = "";
        if (count($data1) > 0){
        $ret .= "<div class='col-md-12'>
                 <div class='service-content ml-20 ml-sm-0'>
                 <h2 class='title mt-0'>Standar Pelayanan Terkait Dengan Proses Penyampaian Pelayanan (Service Point)</h2>";
        foreach ($data1 as $res1){
            $ret .= "<p>".$res1->info_desc."</p>";
        }
            $ret .= "<div class='row mt-30 mb-20'>";
            foreach ($data2 as $res2){
                $ret .= "<div class='col-sm-4 col-md-4'>
                         <ul class='list theme-colored mt-0'>
                         <li class='mb-0'>
                         <a href='".$res2->info_link."' target='_blank'>".$res2->info_title."</a>
                         </li>
                         </ul>
                         </div>";
            }
            $ret .= "</div>";         
        $ret .= "</div>
                 </div>";
        } else {
            $ret .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Penyampaian Pelayanan (Service Point)',
            'menu'          => 'pelayanan',
            'resLayanan'    => $ret,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pelayanan/manufacturing', $data);
    }
    public function layanan_unggulan()
    {
        $unggulan = $this->m_layanan->getLayananByKategori('Layanan Unggulan');
        $urut1 = 1;
        $urut2 = 1;
        $resContent = "";
        if (count($unggulan) > 0){
            $resContent .= "<div class='col-md-12'>";
            $resContent .= "<div class='services-tab border-10px bg-white'>";
            $resContent .= "<ul class='nav nav-tabs'>";
            foreach ($unggulan as $res1){
                if ($urut1 == 1){
                    $active1 = "<li class='active'>";
                } else {
                    $active1 = "<li>";
                }
                $resContent .= "".$active1."
                                <a href='#".$urut1++."' data-toggle='tab'>
                                <i class='flaticon-medical-stethoscopes'></i><span>".$res1->nama."</span>
                                </a>
                                </li>";
            }
            $resContent .= "</ul>";
            $resContent .= "<div class='tab-content'>";
            foreach ($unggulan as $res2){
                if ($urut2 == 1){
                    $active2 = "<div class='tab-pane fade in active' id='".$urut2++."'>";
                } else {
                    $active2 = "<div class='tab-pane' id='".$urut2++."'>";
                }
                $resContent .= "".$active2."
                                <div class='row'>
                                <div class='col-md-7'>
                                <div class='service-content ml-20 ml-sm-0'>
                                <h2 class='title mt-0'>".$res2->nama."</h2>
                                <p>".$res2->deskripsi."</p>
                                </div>
                                </div>
                                <div class='col-md-5'>
                                <div class='thumb'>
                                <img class='img-fullwidth' src='".base_url()."/image/thumbnail/".$res2->thumbnail_nm."'>
                                </div>
                                </div>
                                </div>
                                </div>";
            }
            $resContent .= "</div>";
            $resContent .= "</div>";
            $resContent .= "</div>";
        } else {
            $resContent .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Layanan Unggulan',
            'menu'          => 'pelayanan',
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pelayanan/layanan-unggulan', $data);
    }
    public function layanan_pengaduan()
    {
        $data = [
            'title'         => 'Layanan Pengaduan',
            'menu'          => 'pelayanan',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pelayanan/layanan-pengaduan', $data);
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $nama    = strtoupper($this->request->getPost('nama'));
            $email   = strtolower($this->request->getPost('email'));
            $telepon = $this->request->getPost('telepon');
            $pesan   = $this->request->getPost('pesan');
            $data = [
                'nama'       => $nama,
                'email'      => $email,
                'telepon'    => $telepon,
                'pesan'      => $pesan,
                'lapor_dttm' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_layanan->insertLapor($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Terjadi kesalahan, silahkan coba beberapa saat lagi.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
}
