<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\HarianModel;

class Dashboard extends BaseController
{
    protected $m_harian;
    protected $session;
    public function __construct()
    {
        $this->m_harian  = new HarianModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $user_id = session()->get('user_id');
        // $result['data1'] = $this->m_harian->getNamaKelompokByID($user_id);
        $ket = $this->m_harian->getNamaKelompokByID($user_id);
        foreach ($ket as $key) {
            if ($key->status_user == 'ketua') {
                $res = "<p1>Anda Merupakan <b style='color:red;'>Ketua</b> dari <b style='color:red;'>$key->nama</b></p1>";
            } elseif ($key->status_user == 'anggota') {
                $res = "<p1>Anda Merupakan <b style='color:blue;'>Anggota</b> dari <b style='color:blue;'>$key->nama</b></p1>";
            } else {
                $res = 'Anda Merupakan Dosen Pembimbing Lapangan';
            }
        }
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        $data = [
            'title'  => 'Dashboard',
            'active' => 'dashboard',
            'res_info' => $res,
        ];
        return view('/admin/dashboard', $data);
    }
}
