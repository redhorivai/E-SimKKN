<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\ProdiModel;
use App\Libraries\Date\DateFunction;

class Prodi extends BaseController
{
    protected $m_prodi;
    protected $session;
    public function __construct()
    {
        $this->m_prodi = new ProdiModel();
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
            'title'  => 'Program Studi',
            'active' => 'prodi',
        ];
        return view('admin/prodi/index', $data);
    }
    public function getData()
    {
        $res = $this->m_prodi->getProdi();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                if ($data->fakultas_cd == "ekonomi") {
                    $nm_fakultas = "Fakultas Ekonomi dan Bisnis";
                } elseif ($data->fakultas_cd == "hukum") {
                    $nm_fakultas = "Fakultas Hukum";
                } elseif ($data->fakultas_cd == "pertanian") {
                    $nm_fakultas = "Fakultas Pertanian";
                } elseif ($data->fakultas_cd == "kedokteran") {
                    $nm_fakultas = "Fakultas Kedokteran";
                } elseif ($data->fakultas_cd == "guru") {
                    $nm_fakultas = "Fakultas Keguruan Ilmu Pendidikan";
                } elseif ($data->fakultas_cd == "teknik") {
                    $nm_fakultas = "Fakultas Teknik";
                } else {
                    $nm_fakultas = "Fakultas Agama Islam";
                }

                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='id[]' class='checkedId' value='$data->id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                <div class='mg-l-15'>
                                <a href='javascript:void(0)' class='tx-inverse tx-14 tx-medium d-block'>$data->prodi_nm</a>
                                <span class='tx-13 d-block'>$nm_fakultas</span>
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
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$data->prodi_nm\")'>
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
                            <div class='col-lg-6'>
                                <div class='form-group'>
                                <label class='form-control-label tx-bold'>Fakultas: <span class='tx-danger'>*</span></label>
                                <select class='form-control select2' id='fakultas_cd' name='fakultas_cd' data-placeholder='-- Pilih Fakultas --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                                <option value=''></option>
                                <option value='ekonomi'>Fakultas Ekonomi dan Bisnis</option>
                                <option value='hukum'>Fakultas Hukum</option>
                                <option value='pertanian'>Fakultas Pertanian</option>
                                <option value='kedokteran'>Fakultas Kedokteran</option>
                                <option value='guru'>Fakultas Keguruan Ilmu Pendidikan</option>
                                <option value='teknik'>Fakultas Teknik</option>
                                <option value='agama'>Fakultas Agama Islam</option>
                                </select>
                                </div>
                            </div>
                        <div class='col-lg-6'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Program Studi: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='prodi_nm' name='prodi_nm' onchange='remove(id)'>
                            </div>
                        </div>
                        </div>
                        <div class='row'>
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
                                $('#prodi_nm').removeClass('is-invalid');
                                $('#formData').addClass('d-none');
                                $('#viewData').delay(100).fadeIn();
                            });
                            </script>";
                    return $ret;
            } else {
                $res = $this->m_prodi->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1 forms'>
                        <div class='row'>
                        <div class='col-lg-6'>
                                <div class='form-group'>
                                <label class='form-control-label tx-bold'>Fakultas: <span class='tx-danger'>*</span></label>
                                <select class='form-control select2' id='fakultas_cd' name='fakultas_cd' data-placeholder='-- Pilih Fakultas --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                                <option value=''></option>
                                <option value='ekonomi' " . ($key->fakultas_cd == "ekonomi" ? "selected='selected'" : "") . ">Fakultas Ekonomi dan Bisnis</option>
                                <option value='hukum' " . ($key->fakultas_cd == "hukum" ? "selected='selected'" : "") . ">Fakultas Hukum</option>
                                <option value='pertanian' " . ($key->fakultas_cd == "pertanian" ? "selected='selected'" : "") . ">Fakultas Pertanian</option>
                                <option value='kedokteran' " . ($key->fakultas_cd == "kedokteran" ? "selected='selected'" : "") . ">Fakultas Kedokteran</option>
                                <option value='guru' " . ($key->fakultas_cd == "guru" ? "selected='selected'" : "") . ">Fakultas Keguruan Ilmu Pendidikan</option>
                                <option value='teknik' " . ($key->fakultas_cd == "teknik" ? "selected='selected'" : "") . ">Fakultas Teknik</option>
                                <option value='agama' " . ($key->fakultas_cd == "agama" ? "selected='selected'" : "") . ">Fakultas Agama Islam</option>
                                </select>
                                </div>
                        </div>
                        <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Program Studi: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='prodi_nm' name='prodi_nm' value='$key->prodi_nm' onchange='remove(id)'>
                        </div>
                        </div>
                        </div>
                        <div class='row'>
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
            $fakultas_cd = $this->request->getPost('fakultas_cd');
            $prodi_nm = $this->request->getPost('prodi_nm');
            $data = [
                'fakultas_cd'   => $fakultas_cd,
                'prodi_nm'      => $prodi_nm,
                'created_at'    => date('Y-m-d H:i:s'),
                'created_by'    => session()->get('user_id'),
            ];
            $insert = $this->m_prodi->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Program Studi: <b class='text-danger'>$prodi_nm</b> sudah ada, silahkan coba yang lain.";
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
            $fakultas_cd = $this->request->getPost('fakultas_cd');
            $prodi_nm = $this->request->getPost('prodi_nm');
            $data = [
                'fakultas_cd'   => $fakultas_cd,
                'prodi_nm'      => $prodi_nm,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => session()->get('user_id'),
            ];
            $update = $this->m_prodi->updateData($id, $data);
            if ($update == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Program Studi: <b class='text-danger'>$prodi_nm</b> sudah ada, silahkan coba yang lain.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = [
                'deleted_by' => session()->get('user_id'),
                'deleted_at' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->m_prodi->updateData($id, $data);
            $msg = ['sukses' => 'Data Program Studi telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function multi_del()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++){
                $data = [
                    'deleted_by' => session()->get('user_id'),
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'status_cd'      => 'nullified',
                ];
                $this->m_prodi->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> Program Studi telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}