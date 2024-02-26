<?php

namespace App\Controllers;

use App\Models\Backend\InfoModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\KuisionerModel;

class Pasien extends BaseController
{
    protected $m_info;
    protected $m_instansi;
    protected $m_kuisioner;
    protected $session;
    public function __construct()
    {
        $this->m_info     = new InfoModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_instansi = new InstansiModel();
        $this->m_kuisioner = new KuisionerModel();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $data = [
            'title'         => 'Alur Pelayanan',
            'menu'          => 'pasien',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pasien/alur-pelayanan', $data);
    }
    public function alur_pelayanan()
    {
        $alur       = $this->m_info->getByAlur();
        $resTitle   = "";
        $resContent = "";
        if (count($alur) > 0) {
            $resTitle .= "<div class='col-md-3 scrolltofixed-container'><div class='list-group scrolltofixed z-index-0 mt-40'>";
            $resContent .= "<div class='col-md-9'>";
            foreach ($alur as $res) {
                $detail = $this->m_info->getByTypeLimit($res->info_kat, 0);
                if ($res->info_kat == "registrasi_online") {
                    $kategori = "Alur Registrasi Online";
                } else if ($res->info_kat == "registrasi_loket") {
                    $kategori = "Alur Registrasi Loket";
                } else if ($res->info_kat == "registrasi_apm") {
                    $kategori = "Alur Registrasi APM";
                } else if ($res->info_kat == "registrasi_igd") {
                    $kategori = "Alur Registrasi IGD";
                } else {
                    $kategori = "Alur Registrasi Rawat Inap";
                }
                $resTitle .= "<a href='#" . $res->info_kat . "' class='list-group-item smooth-scroll-to-target'><h5><b>" . $kategori . "</b></h5></a>";
                $resContent .= "<div id='" . $res->info_kat . "' class='pt-40 mb-50'>
                                <h3 class='title mt-0 mb-30 line-bottom'>" . $kategori . "</h3>";
                foreach ($detail as $res) {
                    $resContent .= "
                                    <div class='icon-box mb-0' style='border: solid 1px #DDD; border-radius: 4px;'>
                                    <h4 class='icon-box-title pl-30 pt-15 mt-0 mb-0'>" . $res->info_title . "</h4>
                                    <div class='row'>
                                    <div class='col-md-12'>
                                    <p class='text-gray pl-30 pr-30'>" . $res->info_desc . "</p>
                                    </div>
                                    </div>
                                    </div>";
                }
                $resContent .= "</div>";
            }
            $resTitle .= "</div></div>";
            $resContent .= "</div>";
        } else {
            $resContent .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Alur Pelayanan',
            'menu'          => 'pasien',
            'resTitle'      => $resTitle,
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pasien/alur-pelayanan', $data);
    }
    public function tata_tertib()
    {
        $tatib = $this->m_info->getByTypeLimit('tata_tertib', 0);
        $nomor = 1;
        $no = 1;
        $resTitle = "";
        $resContent = "";
        if (count($tatib) > 0) {
            foreach ($tatib as $res) {
                if (!empty($res->info_image)) {
                    $gambar = "<div class='col-md-4 col-md-offset-4'>
                                <img src='" . base_url() . "/image/info/$res->info_image'>
                               </div>";
                } else {
                    $gambar = "";
                }
                if ($nomor == 1) {
                    $class_li = "active";
                    $class_tab = "in active";
                } else {
                    $class_li = "";
                    $class_tab = "";
                }

                $resTitle .= "<li class='" . $class_li . "'>
                              <a href='#" . $res->info_id . "' data-toggle='tab' style='font-size: 16px !important;padding: 12px 0 12px 0;'>
                              " . $nomor++ . ". " . $res->info_title . "
                              </a>
                              </li>";

                $resContent .= "<div class='tab-pane fade " . $class_tab . "' id='" . $res->info_id . "'>
                                 <div class='icon-box mb-0' style='border: solid 1px #DDD; border-radius: 4px;'>
                                  <a href='javascript:void(0)' class='icon icon-red pull-left mb-0 mr-10'><h3>" . $no++ . "</h3></a>
                                  <h3 class='icon-box-title pt-15 mt-0 mb-40'>" . $res->info_title . "</h3>
                                  <div class='row'>
                                    " . $gambar . "
                                    <div class='col-md-12'>`
                                      <p class='text-gray pl-30 pr-30'>" . $res->info_desc . "</p>
                                    </div>
                                  </div>
                                 </div>
                                </div>";
            }
        } else {
            $resContent .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Tata Tertib',
            'menu'          => 'pasien',
            'resTitle'      => $resTitle,
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pasien/tata-tertib', $data);
    }
    public function hak_kewajiban()
    {
        $hak = $this->m_info->getByTypeLimit('hak_kewajiban', 0);
        $nomor = 1;
        $no = 1;
        $resTitle = "";
        $resContent = "";
        if (count($hak) > 0) {
            foreach ($hak as $res) {
                if (!empty($res->info_image)) {
                    $gambar = "<div class='col-md-4 col-md-offset-4'>
                                <img src='" . base_url() . "/assets-front/images/info/$res->info_image'>
                               </div>";
                } else {
                    $gambar = "";
                }
                if ($nomor == 1) {
                    $class_li = "active";
                    $class_tab = "in active";
                } else {
                    $class_li = "";
                    $class_tab = "";
                }

                $resTitle .= "<li class='" . $class_li . "'>
                              <a href='#" . $res->info_id . "' data-toggle='tab' style='font-size: 16px !important;padding: 12px 0 12px 0;'>
                              " . $nomor++ . ". " . $res->info_title . "
                              </a>
                              </li>";

                $resContent .= "<div class='tab-pane fade " . $class_tab . "' id='" . $res->info_id . "'>
                              <div class='icon-box mb-0' style='border: solid 1px #DDD; border-radius: 4px;'>
                               <a href='javascript:void(0)' class='icon icon-red pull-left mb-0 mr-10'><h3>" . $no++ . "</h3></a>
                               <h3 class='icon-box-title pt-15 mt-0 mb-40'>" . $res->info_title . "</h3>
                               <div class='row'>
                                 " . $gambar . "
                                 <div class='col-md-12'>`
                                   <p class='text-gray pl-30 pr-30'>" . $res->info_desc . "</p>
                                 </div>
                               </div>
                              </div>
                             </div>";
            }
        } else {
            $resContent .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Hak dan Kewajiban Pasien',
            'menu'          => 'pasien',
            'resTitle'      => $resTitle,
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pasien/hak-kewajiban', $data);
    }
    public function pendaftaran_online()
    {
        $data = [
            'title'         => 'Pendaftaran Online',
            'menu'          => 'pasien',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pasien/pendaftaran-online', $data);
    }
    public function faq()
    {
        $faq = $this->m_info->getByTypeLimit('faq', 0);
        $resAccordion = "";
        if (count($faq)) {
            $resAccordion .= "<div class='col-md-8'><div id='accordion1' class='panel-group accordion'>";
            foreach ($faq as $res) {
                $resAccordion .= "<div class='panel'>
                                   <div class='panel-title'> 
                                    <a data-parent='#accordion1' data-toggle='collapse' href='#" . $res->info_id . "' class='collapsed' aria-expanded='false'> <span class='open-sub'></span> Q. " . $res->info_title . "</a> 
                                   </div>
                                   <div id='" . $res->info_id . "' class='panel-collapse collapse' role='tablist' aria-expanded='false' style='height: 0px;'>
                                    <div class='panel-content'>
                                     <p>" . $res->info_desc . "</p>
                                    </div>
                                   </div>
                                  </div>";
            }
            $resAccordion .= "</div></div>";
        } else {
            $resAccordion .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'FAQ',
            'menu'          => 'pasien',
            'resAccordion'  => $resAccordion,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/pasien/faq', $data);
    }
    public function kuisioner()
    {
        $ret = "";
        $class_soal = $this->m_kuisioner->getSoal();
        if (count($class_soal) > 0) {
            $ret .= "<div id='kuisfrm'><ul style='list-style-type:none;'>";
            $no = 1;
            foreach ($class_soal as $soal) {
                $ret .= "<li style='' class='k_tab" . $no . "'><b>" . $soal->soal_nm . "</b>";
                // JAWABAN
                $ret .= $this->renderjawaban($soal->soal_id);
                $ret .= "</li>";
                $no++;
            }
            $ret .= "</div>";
        }


        $data = [
            'title'         => 'Kuisioner',
            'menu'          => 'pasien',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
            'soal_skm'      => $ret
        ];
        return view('front/pages/pasien/kuisioner', $data);
    }
    public function renderJawaban($soal_id)
    {
        $ret = "";
        $jawaban = $this->m_kuisioner->getJawaban($soal_id);
        if (count($jawaban) > 0) {
            $ret .= "<ul style='list-style-type:none;'>";
            foreach ($jawaban as $j) {
                if ($j->jawaban_format == 'radio') {
                    $taginput = "<input style='margin-right:10px;' type='radio' value='$j->nilai' data-jawaban_id='$j->jawaban_id' data-soal_id='$soal_id' name='jawaban_id_$j->jawaban_id' id='soal_id'-/><span style='margin-left:10px;'>" . $j->jawaban_nm . " ($j->nilai)</span>";
                }
                $ret .= "<li> $taginput  </li>";
            }
            $ret .= "</ul>";
        }
        return $ret;
    }
    public function simpanrespon()
    {
        if ($this->request->isAJAX()) {
            $nm_koresponden     = $this->request->getPost('nm_koresponden');
            $jenis_kelamin      = $this->request->getPost('jenis_kelamin');
            $jenis_pendidikan   = $this->request->getPost('jenis_pendidikan');
            $pekerjaan          = $this->request->getPost('pekerjaan');
            $jenis_layanan      = $this->request->getPost('jenis_layanan');
            $data_user = [
                'nm_koresponden'     => $nm_koresponden,
                'jenis_kelamin'      => $jenis_kelamin,
                'jenis_pendidikan'   => $jenis_pendidikan,
                'pekerjaan'          => $pekerjaan,
                'jenis_layanan'      => $jenis_layanan,
                'created_dttm'       => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_kuisioner->simpanJawaban($data_user);
            if ($insert == true) {
                $user_id          = $this->m_kuisioner->insertID();
                $myArray          = $this->request->getPost('myArray');
                $data_array       = json_decode($myArray, true);
                foreach ($data_array as $datas) {
                    $dataJawab = [
                        'soal_id'        => $datas['soal_id'],
                        'jawaban_id'     => $datas['jawaban_id'],
                        'created_user'   => $user_id,
                        'created_dttm'   => date('Y-m-d H:i:s'),
                    ];
                    $this->m_kuisioner->InsertDataRespon($dataJawab);
                }
                $msg = ["sukses" => "Data berhasil disimpan."];
            } else {
                $msg = ["gagal" => "Gagal diperbaharui, silahkan coba beberapa saat lagi."];
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
}
