<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\GabungModel;
use App\Libraries\Date\DateFunction;

class Gabung extends BaseController
{
    protected $session;
    protected $m_gabung;
    public function __construct()
    {
        $this->m_gabung = new GabungModel();
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
        $data = [
            'title'    => 'Gabung Kelompok / Posko',
            'active'   => 'gabung',   
        ];
        return view('admin/gabung/index', $data);
    }
    public function form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $user_id     = session()->get('user_id');
            $kelompok_id = $this->m_gabung->getByIDUserKelompok();
            foreach ($kelompok_id as $key) {
               $opt_kelompok .=  "<option value='$key->id'>$key->nama</option>";
            }

            if ($id == "") {
                $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Tambah Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                csrf_field();
                $ret .= "
                <form class='form-data form-layout-1 forms'>
                    <div class='row'>
                    <div class='col-lg-5'>
                        <div class='form-group'>
                            <label class='form-control-label tx-bold'>Kelompok/Posko : <span class='tx-danger'>*</span></label>
                            <select class='form-control select2' id='kelompok_id' name='kelompok_id' data-placeholder='-- Pilih Kelompok/Posko --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            $opt_kelompok
                            </select>
                        </div>
                    </div>
                    <div class='col-lg-5'>
                        <div class='form-group'>
                            <label class='form-control-label tx-bold'>Status Pengguna : <span class='tx-danger'>*</span></label>
                            <select class='form-control select2' id='status_user' name='status_user' data-placeholder='-- Pilih Status --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            <option value='ketua'>Ketua</option>
                            <option value='anggota'>anggota</option>
                            </select>
                        </div>
                    </div>
                    <div class='col-lg-2'>
                        <div class='form-group'>
                            <div class='input-group'>
                                <input type='hidden' name='user_id' id='user_id' value='$user_id'>
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class='form-layout-footer text-center mg-t-20'>
                    <button type='button' class='btn btn-info' onclick='_simpan()'>Simpan</button>
                    <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                    </div>
                </form>";
                $ret .= "<script>
                         $('.select2').select2();
                         $('#btnCancelForm').click(function() {
                            $('.form-data')[0].reset();
                            $('#kelompok_id').removeClass('is-invalid');
                            $('#status_user').removeClass('is-invalid');
                            $('#user_id').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            }
        } else {
            exit('Request Error');
        }
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $kelompok_id = $this->request->getPost('kelompok_id');
            $status_user = $this->request->getPost('status_user');
            $user_id = $this->request->getPost('user_id');
            $name     = session()->get('name');

            $data = [
                'kelompok_id'      => $kelompok_id,
                'status_user'      => $status_user,
                'user_id'          => $user_id,
                'status_cd'        => 'normal',
                'created_user'     => session()->get('user_id'),
                'created_dttm'     => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_gabung->insertDataID($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Nama: <b class='text-danger'>$name</b> Sudah Gabung Kelompok/Posko, silahkan coba yang lain.";
            }
            return $msg;
        } else {
            $msg = ["error" => "Request Error"];
        }
    }
}