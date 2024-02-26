<?php

namespace App\Controllers;

use App\Models\Backend\InfoModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\ChangelogModel;
use App\Libraries\Date\DateFunction;

class Produk extends BaseController
{
    protected $m_info;
    protected $m_instansi;
    protected $m_clog;
    protected $session;
    public function __construct()
    {
        $this->m_info     = new InfoModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_instansi = new InstansiModel();
        $this->m_clog     = new ChangelogModel();
        $this->date       = new DateFunction();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $data = [
            'title'         => 'BARI Mobile',
            'menu'          => 'produk',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/produk/bari-mobile', $data);
    }
    public function bari_mobile()
    {
        $clog = $this->m_clog->getClogByName('BARI MOBILE');
        $tab_release = "";
        $tab_roadmap = "";
        if (count($clog) > 0) {
            foreach ($clog as $res) {
                $no = 1;
                $gt_issues = $this->m_clog->totIssues($res->clog_id);
                foreach ($gt_issues as $key) {
                    $tot_issues = $key->total_issues;
                }
                $gt_closed = $this->m_clog->totClosed($res->clog_id);
                foreach ($gt_closed as $key) {
                    $tot_closed = $key->total_closed;
                }
                $gt_open = $this->m_clog->totOpen($res->clog_id);
                foreach ($gt_open as $key) {
                    $tot_open = $key->total_open;
                }

                $note = $this->m_clog->getNoteByID($res->clog_id);
                if ($res->status_cd == 'release') {
                    $tab_release .= "<h5>".$res->curr_version." (".$this->date->panjang($res->curr_version_dttm).")</h5>
                                     <pre class='language-markup' style='padding:2em 1em 1em 1em;' data-language='".$tot_issues." issues'>";
                    foreach ($note as $key) {
                        $tab_release .= "<span>".$no++.". ".$key->clog_type.": ".$key->description."</span><br>";
                    }                
                    $tab_release .= "</pre>";
                } else {
                    $tab_roadmap .= "<h5>".$res->curr_version." (Next Release)</h5>
                                     <pre class='language-markup' style='padding:2em 1em 1em 1em;' data-language='".$tot_issues." issues (".$tot_closed." closed -- ".$tot_open." open)'>";
                    foreach ($note as $key) {
                        if ($key->status_cd == "closed") {
                            $clog_type = "<span style='color:#999;text-decoration:line-through;'>".$key->clog_type."</span>";
                        } else {
                            $clog_type = "".$key->clog_type."";
                        }
                        $tab_roadmap .= "<span>".$no++.". ".$clog_type.": ".$key->description."</span><br>";
                    }                
                    $tab_roadmap .= "</pre>";
                }
            }
        } else {
            $tab_release .= "<h6 class='text-center'>Belum ada data yang ditambahkan.</h6>";
            $tab_roadmap .= "<h6 class='text-center'>Belum ada data yang ditambahkan.</h6>";
        }
        
        $data = [
            'title'         => 'BARI Mobile',
            'menu'          => 'produk',
            'tab_release'   => $tab_release,
            'tab_roadmap'   => $tab_roadmap,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/produk/bari-mobile', $data);
    }
    public function apm()
    {
        $clog = $this->m_clog->getClogByName('APM');
        $tab_release = "";
        $tab_roadmap = "";
        if (count($clog) > 0) {
            foreach ($clog as $res) {
                $no = 1;
                $gt_issues = $this->m_clog->totIssues($res->clog_id);
                foreach ($gt_issues as $key) {
                    $tot_issues = $key->total_issues;
                }
                $gt_closed = $this->m_clog->totClosed($res->clog_id);
                foreach ($gt_closed as $key) {
                    $tot_closed = $key->total_closed;
                }
                $gt_open = $this->m_clog->totOpen($res->clog_id);
                foreach ($gt_open as $key) {
                    $tot_open = $key->total_open;
                }

                $note = $this->m_clog->getNoteByID($res->clog_id);
                if ($res->status_cd == 'release') {
                    $tab_release .= "<h5>".$res->curr_version." (".$this->date->panjang($res->curr_version_dttm).")</h5>
                                     <pre class='language-markup' style='padding:2em 1em 1em 1em;' data-language='".$tot_issues." issues'>";
                    foreach ($note as $key) {
                        $tab_release .= "<span>".$no++.". ".$key->clog_type.": ".$key->description."</span><br>";
                    }                
                    $tab_release .= "</pre>";
                } else {
                    $tab_roadmap .= "<h5>".$res->next_version." (Next Release)</h5>
                                     <pre class='language-markup' style='padding:2em 1em 1em 1em;' data-language='".$tot_issues." issues (".$tot_closed." closed -- ".$tot_open." open)'>";
                    foreach ($note as $key) {
                        if ($key->status_cd == "closed") {
                            $clog_type = "<span style='color:#999;text-decoration:line-through;'>".$key->clog_type."</span>";
                        } else {
                            $clog_type = "".$key->clog_type."";
                        }
                        $tab_roadmap .= "<span>".$no++.". ".$clog_type.": ".$key->description."</span><br>";
                    }                
                    $tab_roadmap .= "</pre>";
                }
            }
        } else {
            $tab_release .= "<h6 class='text-center'>Belum ada data yang ditambahkan.</h6>";
            $tab_roadmap .= "<h6 class='text-center'>Belum ada data yang ditambahkan.</h6>";
        }
        
        $data = [
            'title'         => 'Anjungan Pendaftaran Mandiri (APM)',
            'menu'          => 'produk',
            'tab_release'   => $tab_release,
            'tab_roadmap'   => $tab_roadmap,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/produk/apm', $data);
    }
}
