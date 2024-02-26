<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\DaftarModel;

class Auth extends BaseController
{
    public function index()
    {
       show_404();
    }

    public function register()
    {
        $this->m_daftar->insertData();
        return view('admin/daftar');
    }

    // public function insert_data()
    // {
    //     if ($this->request->isAJAX()) {
    //         $name     = $this->request->getPost('name');
    //         $username = strtolower($this->request->getPost('username'));
    //         $klasifikasi   = $this->request->getPost('klasifikasi');
    //         $gender   = $this->request->getPost('gender');
    //         $email   = $this->request->getPost('email');
    //         $phone   = $this->request->getPost('phone');
    //         $tempat_lahir    = $this->request->getPost('tempat_lahir');
    //         $tanggal_lahir  = $this->request->getPost('tanggal_lahir');
    //         $level    = $this->request->getPost('level');
    //         $address  = $this->request->getPost('address');
    //         $data = [
    //             'name'           => $name,
    //             'username'       => $username,
    //             'klasifikasi'    => $klasifikasi,
    //             'gender'         => $gender,
    //             'email'          => $email,
    //             'phone'          => $phone,
    //             'tempat_lahir'   => $tempat_lahir,
    //             'tanggal_lahir'  => $tanggal_lahir,
    //             'level'          => $level,
    //             'address'        => $address,
    //             'password'       => sha1(md5('123456')),
    //             'status_cd'      => 'normal',
    //             'created_user'   => NULL,
    //             'created_dttm'   => date('Y-m-d H:i:s'),
    //         ];
    //         // var_dump($data);
    //         $insert = $this->m_daftar->insertData($data);
    //         if ($insert == true) {
    //             $created_user       = $this->m_daftar->insertID();
    //             $dok_pendaftaran = $this->request->getFile('dok_pendaftaran');
    //             $path_file = $dok_pendaftaran->getRandomName();
    //             $dok_pendaftaran->move('assets-admin/panel/document/pendaftaran', $path_file);
    //             $data2 = [
    //                 'created_user'  => $created_user,
    //                 'dok_pendaftaran' => $path_file,
    //                 'created_dttm'   => date('Y-m-d H:i:s'),
    //             ];
    //             // var_dump($data2);
    //             $this->m_daftar->insertDokDaftar($data2);
    //         }
    //         if ($insert == true) {
    //             $msg = "Sukses";
    //         } else {
    //             $msg = "NIM/NIDN: <b class='text-danger'>$username</b> sudah ada, silahkan coba yang lain.";
    //         }
    //         return $msg;
    //     } else {
    //         exit('Request Error');
    //     }
    // }
}
