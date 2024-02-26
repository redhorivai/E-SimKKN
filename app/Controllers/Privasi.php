<?php

namespace App\Controllers;

use App\Models\Backend\LayananModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\PenggunaModel;
use App\Libraries\Date\DateFunction;

class Privasi extends BaseController
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
        $data = [
            'title'         => 'Kebijakan Privasi',
            'menu'          => 'home',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/privasi', $data);
    }
}
