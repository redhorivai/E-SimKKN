<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\PengaduanModel;
use App\Libraries\Date\DateFunction;

class Pengaduan extends BaseController
{
    protected $m_adu;
    protected $session;
    public function __construct()
    {
        $this->m_adu   = new PengaduanModel();
        $this->date    = new DateFunction();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function getData()
    {
        $adu = $this->m_adu->getAdu();
        if (count($adu) > 0){
            $data = array (
                'kode'    => '200',
                'message' => 'oke',
                'result'  => $adu,
            );
        } else {
            $data = array (
                'kode'    => '201',
                'message' => 'gagal'
            );
        }
        // $sml = json_decode($data);
        // return $this->response->setJSON($sml);
        return $this->response->setJSON($data);

    }
}