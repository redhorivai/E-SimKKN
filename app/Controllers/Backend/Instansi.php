<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\InstansiModel;
use App\Libraries\Date\DateFunction;

class Instansi extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->m_instansi = new InstansiModel();
        $this->date = new DateFunction();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        $instansi = $this->m_instansi->getInstansi();
        $data = [
            'title'    => 'Instansi',
            'active'   => 'instansi',
            'instansi' => $instansi,
        ];
        return view('admin/instansi/index', $data);
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('company_id');
            $valid = $this->validate([
                'company_nm'          => ['rules' => 'required'],
                'email'               => ['rules' => 'required'],
                'cellphone_informasi' => ['rules' => 'required'],
                'addr_txt'            => ['rules' => 'required'],
                'company_logo' => [
                    'label' => 'Logo',
                    'rules' => 'max_size[company_logo,3072]|is_image[company_logo]|mime_in[company_logo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Maksimal ukuran file 3 MB',
                        'is_image' => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'company_nm'          => $this->validation->getError('company_nm'),
                        'email'               => $this->validation->getError('email'),
                        'cellphone_informasi' => $this->validation->getError('cellphone_informasi'),
                        'addr_txt'            => $this->validation->getError('addr_txt'),
                        'company_logo'        => $this->validation->getError('company_logo'),
                    ]
                ];
            } else {
                $fileImg = $this->request->getFile('company_logo');
                $logoLama = $this->request->getPost('logoLama');
                if ($fileImg->getError() == 4) {
                    $company_logo = $logoLama;
                } else {
                    $company_logo = $fileImg->getRandomName();
                    $fileImg->move('assets-front/images/logo', $company_logo);
                    if ($logoLama != 'no_image.png') {
                        unlink('assets-front/images/logo/' . $logoLama);
                    }
                }

                $data = [
                    'company_nm'           => $this->request->getPost('company_nm'),
                    'email'                => $this->request->getPost('email'),
                    'cellphone_informasi'  => $this->request->getPost('cellphone_informasi'),
                    'cellphone_sms_online' => $this->request->getPost('cellphone_sms_online'),
                    'cellphone_marketing'  => $this->request->getPost('cellphone_marketing'),
                    'addr_txt'             => $this->request->getPost('addr_txt'),
                    'link_website'         => $this->request->getPost('link_website'),
                    'facebook'             => $this->request->getPost('facebook'),
                    'instagram'            => $this->request->getPost('instagram'),
                    'company_logo'         => $company_logo,
                    'updated_user'         => session()->get('user_id'),
                    'updated_dttm'         => date('Y-m-d H:i:s'),
                ];
                $this->m_instansi->updateData($id, $data);
                $msg = [
                    'sukses' => 'Profil instansi berhasil diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}