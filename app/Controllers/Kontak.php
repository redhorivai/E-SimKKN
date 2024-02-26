<?php

namespace App\Controllers;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\ArtikelModel;

class Kontak extends BaseController
{
    protected $m_company;
    protected $m_artikel;
    protected $session;
    public function __construct()
    {
        $this->m_company = new InstansiModel();
        $this->m_artikel = new ArtikelModel();
        $this->session   = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $company = $this->m_company->getInstansi();
        $resCompany = "";
        if (count($company) > 0){
            foreach ($company as $res ){
                $resCompany .= "<div class='col-sm-12 col-md-4'>
                                    <div class='contact-info text-center pt-60 pb-60 border-right'>
                                    <i class='fa fa-phone font-36 mb-10 text-theme-colored'></i>
                                    <h4>Telepon</h4>
                                    <h6 class='text-gray'><b class='text-dark'>Informasi:</b> ".$res->cellphone_informasi."</h6>
                                    <h6 class='text-gray'><b class='text-dark'>SMS Online:</b> ".$res->cellphone_sms_online."</h6>
                                    <h6 class='text-gray'><b class='text-dark'>Pemasaran:</b> ".$res->cellphone_marketing."</h6>
                                    </div>
                                </div>
                                <div class='col-sm-12 col-md-4'>
                                    <div class='contact-info text-center  pt-60 pb-60 border-right'>
                                    <i class='fa fa-map-marker font-36 mb-10 text-theme-colored'></i>
                                    <h4>Alamat</h4>
                                    <h6 class='text-gray'>".$res->addr_txt."</h6>
                                    </div>
                                </div>
                                <div class='col-sm-12 col-md-4'>
                                    <div class='contact-info text-center  pt-60 pb-60'>
                                    <i class='fa fa-envelope font-36 mb-10 text-theme-colored'></i>
                                    <h4>e-Mail</h4>
                                    <h6 class='text-gray'>".$res->email."</h6>
                                    </div>
                                </div>";
            }
        } else {
            $resCompany .= "";
        }
        $data = [
            'title'         => 'Kontak',
            'menu'          => 'kontak',
            'resCompany'    => $resCompany,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $company,
        ];
        return view('front/pages/kontak/kontak', $data);
    }
}
