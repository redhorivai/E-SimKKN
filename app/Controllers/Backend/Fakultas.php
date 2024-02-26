<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\FakultasModel;
use App\Libraries\Date\DateFunction;

class Fakultas extends BaseController
{
    protected $m_fakultas;
    protected $session;
    public function __construct()
    {
        $this->m_fakultas = new FakultasModel();
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
            'title'  => 'Fakultas',
            'active' => 'fakultas',
        ];
        return view('admin/fakultas/index', $data);
    }
    public function getData()
    {
        $res = $this->m_fakultas->getFakultas();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='info_id[]' class='checkedId' value='$data->id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                <div class='mg-l-15'>
                                <a href='javascript:void(0)' class='tx-inverse tx-14 tx-medium d-block'>$data->nama</a>
                                <span class='tx-13 d-block'>$data->info_desc</span>
                                <span class='tx-13'>Admin | ".$this->date->panjang($data->created_at)."</span>
                                </div>
                                </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_btnEdit($data->id)'>
                                 <i class='icon-note'></i> <span style='vertical-align:text-top;'>Perubahan</span>
                                 </a>			  
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$data->nama\")'>
                                 <i class='icon-trash'></i> <span style='vertical-align:text-top;'>Hapus</span>
                                 </a>
                                 </nav>
                                 </div>
                                 </div>",
                );
                $ret = array(
                    'data' => $output,
                );
            }
        } else {
            $ret = array(
                'data' => [],
            );
        }
        return $this->response->setJSON($ret);
    }
    public function form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            if ($id == "") {
                $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Tambah Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                csrf_field();
                $ret .= "
                <form class='form-data form-layout-1 forms'>
                    <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Nama Fakultas: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='nama' name='nama' onchange='remove(id)'>
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
                            $('#nama').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } else {
                $res = $this->m_fakultas->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1 forms'>
                        <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Nama Fakultas: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='nama' name='nama' value='$key->nama' onchange='remove(id)'>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class='form-layout-footer text-center mg-t-20'>
                        <button type='button' class='btn btn-success' onclick='_update($key->id)'>Update</button>
                        <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                        </div>
                    </form>";
                    $ret .= "<script>
                            $('.select2').select2();
                            $('#btnCancelForm').click(function() {
                                $('.form-data')[0].reset();
                                $('#nama').removeClass('is-invalid');
                                $('#formData').addClass('d-none');
                                $('#viewData').delay(100).fadeIn();
                            });
                            </script>";
                    return $ret;  
                }
            }
        } else {
            exit('Request Error');
        }
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $nama = $this->request->getPost('nama');
            $data = [
                'nama'   => $nama,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('user_id'),
            ];
            $insert = $this->m_fakultas->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Fakultas: <b class='text-danger'>$nama</b> sudah ada, silahkan coba yang lain.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id         = $this->request->getPost('id');
            $nama = $this->request->getPost('nama');
            $data = [
                'nama'   => ucwords($nama),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => session()->get('user_id'),
            ];
            $update = $this->m_fakultas->updateData($id, $data);
            if ($update == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Fakultas: <b class='text-danger'>$nama</b> sudah ada, silahkan coba yang lain.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
    // public function del_data()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('info_id');
    //         $data = [
    //             'nullified_user' => session()->get('user_id'),
    //             'nullified_dttm' => date('Y-m-d H:i:s'),
    //             'status_cd'      => 'nullified',
    //         ];
    //         $this->m_info->updateData($id, $data);
    //         $msg = ['sukses' => 'Data hak & kewajiban telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function multi_del()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('info_id');
    //         $jmldata = count($id);
    //         for ($i = 0; $i < $jmldata; $i++){
    //             $data = [
    //                 'nullified_user' => session()->get('user_id'),
    //                 'nullified_dttm' => date('Y-m-d H:i:s'),
    //                 'status_cd'      => 'nullified',
    //             ];
    //             $this->m_info->updateData($id[$i], $data);
    //         }
    //         $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> hak & kewajiban telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
}