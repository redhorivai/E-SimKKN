<?php

namespace App\Controllers;

use App\Models\Backend\LayananModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\PenggunaModel;
use App\Libraries\Date\DateFunction;

class Home extends BaseController
{
    protected $m_layanan;
    protected $m_artikel;
    protected $m_instansi;
    protected $m_pengguna;
    protected $session;
    public function __construct()
    {
        $this->m_layanan  = new LayananModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_instansi = new InstansiModel();
        $this->m_pengguna = new PenggunaModel();
        $this->date       = new DateFunction();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        // LAYANAN UNGGULAN
        $unggulan = $this->m_layanan->getLayananByKategori('Layanan Unggulan');
        $urut1 = 1;
        $urut2 = 1;
        $resLayananUnggulan = "";
        if (count($unggulan) > 0) {
            $resLayananUnggulan .= "<div class='col-md-12'>";
            $resLayananUnggulan .= "<div class='services-tab border-10px bg-white'>";
            $resLayananUnggulan .= "<ul class='nav nav-tabs'>";
            foreach ($unggulan as $res1) {
                if ($urut1 == 1) {
                    $active1 = "<li class='active'>";
                } else {
                    $active1 = "<li>";
                }
                $resLayananUnggulan .= "" . $active1 . "
                                <a href='#" . $urut1++ . "' data-toggle='tab'>
                                <i class='flaticon-medical-stethoscopes'></i><span>" . $res1->nama . "</span>
                                </a>
                                </li>";
            }
            $resLayananUnggulan .= "</ul>";
            $resLayananUnggulan .= "<div class='tab-content'>";
            foreach ($unggulan as $res2) {
                if ($urut2 == 1) {
                    $active2 = "<div class='tab-pane fade in active' id='" . $urut2++ . "'>";
                } else {
                    $active2 = "<div class='tab-pane' id='" . $urut2++ . "'>";
                }
                $jmlStrDesc = strlen($res2->deskripsi);
                if ($jmlStrDesc >= 1000) {
                    $descStr = substr($res2->deskripsi, 0, 1000);
                    $deskripsi = $descStr . '... <a class="text-theme-colored" href="'.base_url('/pelayanan/layanan_unggulan').'" style="margin-left:5px;">Selengkapnya <i class="fa fa-angle-double-right"></i></a>';
                } else {
                    $deskripsi = $res2->deskripsi;
                }
                $resLayananUnggulan .= "" . $active2 . "
                                <div class='row'>
                                <div class='col-md-7'>
                                <div class='service-content ml-20 ml-sm-0'>
                                <h2 class='title mt-0'>" . $res2->nama . "</h2>
                                <p>" . $deskripsi . "</p>
                                </div>
                                </div>
                                <div class='col-md-5'>
                                <div class='thumb'>
                                <img class='img-fullwidth' src='" . base_url() . "/image/thumbnail/" . $res2->thumbnail_nm . "'>
                                </div>
                                </div>
                                </div>
                                </div>";
            }
            $resLayananUnggulan .= "</div>";
            $resLayananUnggulan .= "</div>";
            $resLayananUnggulan .= "</div>";
        } else {
            $resLayananUnggulan .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        // ARTIKEL
        $artikel = $this->m_artikel->getBerita();
        $resArtikel = "";
        if (count($artikel) > 0) {
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
                $tgl = date('d', strtotime($res->created_dttm));
                $bln = date('M', strtotime($res->created_dttm));
                $resArtikel .= "<div class='item'>
                                    <article class='post clearfix bg-lighter'>
                                    <div class='entry-header'>
                                        <div class='post-thumb thumb'>
                                        <img src='".base_url()."/image/artikel/".$res->thumbnail_nm."' class='img-responsive img-fullwidth'>
                                        </div>
                                        <div class='entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15'>
                                        <ul>
                                            <li class='font-16 text-white font-weight-600'>".$tgl."</li>
                                            <li class='font-12 text-white text-uppercase'>".$bln."</li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class='entry-content p-15 pt-10 pb-10'>
                                        <div class='entry-meta media no-bg no-border mt-0 mb-10'>
                                        <div class='media-body pl-0'>
                                            <div class='event-content pull-left flip'>
                                            <h4 class='entry-title text-white text-uppercase font-weight-600 m-0 mt-5'><a href='".base_url('/informasi/detail_artikel/'.$res->artikel_id.'')."'>".$title."</a></h4>
                                            <ul class='list-inline entry-date font-12 mt-5'>
                                            <li class='pr-0'>
                                            <small class='text-theme-colored' href='javascript:void(0)'>".$nama." | " . $this->date->panjang($res->created_dttm) . "</small>
                                            </li>
                                            </ul>
                                            </div>
                                        </div>
                                        </div>
                                        <p class='mt-5'>".$description."</p>
                                        <a href='" . base_url('/informasi/detail_artikel/' . $res->artikel_id . '') . "' class='btn btn-dark btn-theme-colored btn-xs btn-flat mt-0'>Selengkapnya</a>
                                    </div>
                                    </article>
                                    </div>";
            }
        }
        
        $data = [
            'title'              => 'Beranda',
            'menu'               => 'home',
            'resLayananUnggulan' => $resLayananUnggulan,
            'resArtikel'         => $resArtikel,
            'artikelFooter'      => $this->m_artikel->getLimit('3'),
            'dataInstansi'       => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/beranda', $data);
    }
}
