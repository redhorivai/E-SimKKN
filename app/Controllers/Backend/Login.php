<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\LoginModel;

class Login extends BaseController
{
    protected $m_login;
    protected $session;
    public function __construct()
    {
        $this->m_login = new LoginModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        $data = [
            'title' => 'Login Area',
        ];
        return view('admin/login', $data);
    }

    public function get_login()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getPost('username');
            $password = sha1(md5($this->request->getPost('password')));
            $cek_user = $this->m_login->user_check($username);
                if ($cek_user['status_acc'] == 'deactive') {
                    $msg = ['gagal' => "Login Gagal.. Akun Anda tidak aktif."];
                } else if ($cek_user['username'] != $username) {
                    $msg = ['gagal' => "Login Gagal.. Username tidak ditemukan."];
                } else {
                    $cek = $this->m_login->login_check($username, $password);
                    if ($cek['username'] == $username && $cek['password'] == $password) {
                        session()->set('user_id', $cek['user_id']);
                        session()->set('name', $cek['name']);
                        session()->set('username', $cek['username']);
                        session()->set('level', $cek['level']);
                        session()->set('gender', $cek['gender']);
                        session()->set('avatar', $cek['avatar']);
                        $msg = ['sukses' => 'Selamat Datang.. ' . session()->get('name') . '',];
                    } else {
                        $msg = ['gagal' => "Login Gagal.. Username atau Kata Sandi yang Anda masukkan salah."];
                    } 
                }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function logout()
    {
        session()->setTempdata('user_id');
        session()->setTempdata('name');
        session()->setTempdata('username');
        session()->setTempdata('level');
        session()->setTempdata('gender');
        session()->setTempdata('avatar');
        session()->setFlashdata('sukses', 'Anda telah logout ..');
        return redirect()->to(base_url('/panel'));
    }
}
