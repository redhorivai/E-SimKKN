<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\Api\M_Bcms;
use App\Libraries\Date\DateFunction;
use App\Libraries\Currency\Currency;

class Bcms extends BaseController
{
    public function __construct()
    {
        $this->m_bcms = new M_Bcms();
        $this->date = new DateFunction();
        $this->currency = new Currency();
        $this->db = \Config\Database::connect();
    }

    public function getCompany()
    {
        $getCompany = $this->m_bcms->getCompany();
        if (count($getCompany) > 0) {
            foreach ($getCompany as $data) {
                $dataCompany = array(
                    "comp_id" => $data->company_id,
                    "comp_nm" => $data->company_nm,
                    "addr_txt" => $data->addr_txt,
                    "company_logo" => $data->company_logo,
                    "link_website" => $data->link_website,
                    "email" => $data->email,
                    "facebook" => $data->facebook,
                    "instagram" => $data->instagram,
                    "cellphone_informasi" => $data->cellphone_informasi,
                    "cellphone_marketing" => $data->cellphone_marketing,
                    "cellphone_sms_online" => $data->cellphone_sms_online,
                );

                $ret = array(
                    'kode' => 200,
                    'error' => false,
                    'message' => 'ok',
                    'result' => $dataCompany
                );
            }
        } else {
            $ret = array(
                'kode' => 204,
                'error' => true,
                'message' => 'empty data'
            );
        }
        return $this->response->setJSON($ret);
    }

    public function getInfo()
    {
        // $kategory = 'tata_tertib';
        $kategory = $this->request->getPost('kategory');
        $getInfo = $this->m_bcms->getInfo($kategory);
        $no = 1;
        if (count($getInfo) > 0) {
            foreach ($getInfo as $data) {
                $dataInfo[] = array(
                    "no" => $no++,
                    "kategory" => $data->info_kat,
                    "title" => $data->info_title,
                    "subtitle" => $data->info_subtitle,
                    "content" => $data->info_desc,
                    "image" => $data->info_image,
                );

                $ret = array(
                    'kode' => 200,
                    'error' => false,
                    'message' => 'ok',
                    'result' => $dataInfo
                );
            }
        } else {
            $ret = array(
                'kode' => 204,
                'error' => true,
                'message' => 'empty data'
            );
        }
        return $this->response->setJSON($ret);
    }

    public function getLayananUnggulan()
    {
        // $limit = 0;
        // $kategory = 'Layanan Unggulan';
        $limit = $this->request->getPost('limit');
        $kategory = $this->request->getPost('kategory');

        $getLayanan = $this->m_bcms->getLayananUnggulan($kategory, $limit);
        if (count($getLayanan) > 0) {
            foreach ($getLayanan as $data) {
                $dataLayanan[] = array(
                    "layanan_id" => $data->layanan_id,
                    "kategory" => $data->kategory,
                    "nama" => $data->nama,
                    "deskripsi" => $data->deskripsi,
                    "banner_nm" => $data->banner_nm,
                    "thumbnail_nm" => $data->thumbnail_nm,
                    "created_dttm" => $this->date->panjang($data->created_dttm)
                );

                $ret = array(
                    'kode' => 200,
                    'error' => false,
                    'message' => 'ok',
                    'result' => $dataLayanan
                );
            }
        } else {
            $ret = array(
                'kode' => 204,
                'error' => true,
                'message' => 'empty data'
            );
        }
        return $this->response->setJSON($ret);
    }

    public function getArtikel()
    {
        // $limit = 3;
        $limit = $this->request->getPost('limit');
        $type = 'artikel';

        $getArtikel = $this->m_bcms->getArtikel($limit, $type);
        if (count($getArtikel) > 0) {
            foreach ($getArtikel as $data) {
                $dataArtikel[] = array(
                    "artikel_id" =>  $data->artikel_id,
                    "title" =>  $data->title,
                    "description" =>  $data->description,
                    'description_limit' => substr($data->description, 0, 150).'...',
                    "banner_nm" => $data->banner_nm,
                    "thumbnail_nm" =>  $data->thumbnail_nm,
                    "status_cd" =>  $data->status_cd,
                    "created_dttm" => $this->date->panjang($data->created_dttm)
                );

                $ret = array(
                    'kode' => 200,
                    'error' => false,
                    'message' => 'ok',
                    'result' => $dataArtikel
                );
            }
        } else {
            $ret = array(
                'kode' => 204,
                'error' => true,
                'message' => 'empty data'
            );
        }
        return $this->response->setJSON($ret);
    }


    public function insertPengaduan(){
        
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $telp = $this->request->getPost('telp');
        $catatan = $this->request->getPost('catatan');

        $dataKirim = array(
            'nama_pengirim' => $nama,
            'email' => $email,
            'no_telp'	=> $telp,
            'catatan' => $catatan,
            'created_dttm' => $this->date->dateNow(),
        );

        $insertPengaduan = $this->m_bcms->insertPengaduan($dataKirim);
        if($insertPengaduan == true){
            $ret = array(
                'kode' => 200,
                'error' => false,
                'message' => 'ok',
            );
        } else {
            $ret = array(
                'kode' => 500,
                'error' => true,
                'message' => 'Internal server error'
            );
        }
        return $this->response->setJSON($ret);
    }

    public function getSlider(){
        $limit = $this->request->getPost('limit');
        $type = 'slider';

        $getSlider = $this->m_bcms->getArtikel($limit, $type);
        if (count($getSlider) > 0) {
            foreach ($getSlider as $data) {
                $dataArtikel[] = array(
                    "artikel_id" =>  $data->artikel_id,
                    "title" =>  $data->title,
                    "description" =>  $data->description,
                    'description_limit' => substr($data->description, 0, 150).'...',
                    "banner_nm" => $data->banner_nm,
                    "thumbnail_nm" =>  $data->thumbnail_nm,
                    "status_cd" =>  $data->status_cd,
                    "created_dttm" => $this->date->panjang($data->created_dttm)
                );

                $ret = array(
                    'kode' => 200,
                    'error' => false,
                    'message' => 'ok',
                    'result' => $dataArtikel
                );
            }
        } else {
            $ret = array(
                'kode' => 204,
                'error' => true,
                'message' => 'empty data'
            );
        }
        return $this->response->setJSON($ret);
    }
}
