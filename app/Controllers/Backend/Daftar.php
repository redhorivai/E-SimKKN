<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\DaftarModel;

class Daftar extends BaseController
{
    protected $m_daftar;
    protected $session;
    public function __construct()
    {
        $this->m_daftar = new DaftarModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Area',
        ];
        return view('admin/daftar', $data);
    }

    public function Upload()
    {
           
        $name     = $this->request->getPost('name');
        $username = $this->request->getPost('username');
        $klasifikasi   = $this->request->getPost('klasifikasi');
        $gender   = $this->request->getPost('gender');
        $email   = $this->request->getPost('email');
        $phone   = $this->request->getPost('phone');
        $tempat_lahir    = $this->request->getPost('tempat_lahir');
        $tanggal_lahir  = $this->request->getPost('tanggal_lahir');
        $level    = $this->request->getPost('level');
        $address  = $this->request->getPost('address');
        $file = $this->request->getFile('path_dok');
        // Validasi file
        if ($file->isValid() && !$file->hasMoved()) {
            $path_file = $file->getRandomName();
            $file->move('assets-admin/panel/document/pendaftaran', $path_file);
            $data = [
                'name'           => $name,
                'username'       => $username,
                'klasifikasi'    => $klasifikasi,
                'gender'         => $gender,
                'email'          => $email,
                'phone'          => $phone,
                'tempat_lahir'   => $tempat_lahir,
                'tanggal_lahir'  => $tanggal_lahir,
                'level'          => $level,
                'address'        => $address,
                'password'       => sha1(md5('123456')),
                'status_acc'      => 'deactive',
                'status_cd'      => 'normal',
                'created_user'   => NULL,
                'created_dttm'   => date('Y-m-d H:i:s'),
                'path_dok'       => $path_file
            ];
            $input = $this->m_daftar->insertData($data);
            if ($input == true) {
                header("HTTP/1.1 200 OK");
                 echo "<script>alert('Data Berhasil Disimpan')</script>";
                 echo '<script>window.location.href="'.base_url('/panel').'"</script>';
            } else {
                header('X-PHP-Response-Code: 400', true, 400);
                echo "<script>alert('nim sudah terdaftar')</script>";
                echo '<script>window.location.href="' . base_url('/daftar') . '"</script>';
            }
        } else {
            header('X-PHP-Response-Code: 403', true, 403);
            echo "<script>alert('Data Gagal Disimpan')</script>";
            echo '<script>window.location.href="' . base_url('/daftar') . '"</script>';
        }
    }
}
