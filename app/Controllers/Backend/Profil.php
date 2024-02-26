<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\ProfilModel;
use App\Libraries\Date\DateFunction;

class Profil extends BaseController
{
    protected $session;
    protected $m_profil;
    public function __construct()
    {
        $this->m_profil = new ProfilModel();
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
        $profil = $this->m_profil->getProfil();
        $data = [
            'title'    => 'Profil',
            'active'   => 'profil',
            'profil'   => $profil,
        ];
        return view('admin/profil/index', $data);
    }
    // public function update_data()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('id');
    //         $valid = $this->validate([
    //             'nama'          => ['rules' => 'required'],
    //             // 'no_id'         => ['rules' => 'required'],
    //             // 'jenis_kelamin' => ['rules' => 'required'],
    //             'alamat'        => ['rules' => 'required'],
    //             // 'foto' => [
    //             //     'label' => 'Logo',
    //             //     'rules' => 'max_size[foto,3072]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
    //             //     'errors' => [
    //             //         'max_size' => 'Maksimal ukuran file 3 MB',
    //             //         'is_image' => 'Hanya eksetensi .png | .jpg | .jpeg',
    //             //         'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
    //             //     ]
    //             // ],
    //         ]);
    //         if (!$valid) {
    //             $msg = [
    //                 'error' => [
    //                     'nama'          => $this->validation->getError('nama'),
    //                     // 'no_id'         => $this->validation->getError('no_id'),
    //                     // 'jenis_kelamin' => $this->validation->getError('jenis_kelamin'),
    //                     'alamat'        => $this->validation->getError('alamat'),
    //                     // 'foto'          => $this->validation->getError('foto'),
    //                 ]
    //             ];
    //         } else {
    //             $fileImg = $this->request->getFile('foto');
    //             $logoLama = $this->request->getPost('logoLama');
    //             if ($fileImg->getError() == 4) {
    //                 $foto = $logoLama;
    //             } else {
    //                 $foto = $fileImg->getRandomName();
    //                 $fileImg->move('assets-admin/panel/images/users', $foto);
    //                 if ($logoLama != 'no_image.png') {
    //                     unlink('assets-admin/panel/images/users/' . $logoLama);
    //                 }
    //             }

    //             $data = [
    //                 'nama'           => $this->request->getPost('nama'),
    //                 'no_id'                => $this->request->getPost('no_id'),
    //                 // 'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
    //                 'tempat_lahir' => $this->request->getPost('tempat_lahir'),
    //                 'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
    //                 'alamat'             => $this->request->getPost('alamat'),
    //                 // 'prodi_nm'         => $this->request->getPost('prodi_nm'),
    //                 // 'foto'         => $foto,
    //                 'updated_at'         => date('Y-m-d H:i:s'),
    //                 'updated_by'         => session()->get('user_id'),
    //             ];
    //             $this->m_profil->updateData($id, $data);
    //             $msg = [
    //                 'sukses' => 'Profil Anda berhasil diperbaharui'
    //             ];
    //         }
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
}