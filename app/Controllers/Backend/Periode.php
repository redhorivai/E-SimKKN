<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\PeriodeModel;
use App\Libraries\Date\DateFunction;

class Periode extends BaseController
{
    protected $m_periode;
    protected $session;
    public function __construct()
    {
        $this->m_periode = new PeriodeModel();
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
            'title'  => 'Data Periode',
            'active' => 'periode',
        ];
        return view('admin/periode/index', $data);
    }
    public function getData()
    {
        $res = $this->m_periode->getPeriode();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                if ($data->status == '1') {
                    $status = "<span class='square-8 bg-info rounded-circle'></span> Aktif";
                    $button = "<button type='button' class='btn btn-danger tx-white' onclick='_deactive(\"$data->id\",\"$data->periode_nm\")'>
                               <i class='fa fa-times'></i>
                               </button>";
                } else {
                    $status = "<span class='square-8 bg-danger rounded-circle'></span> Tidak Aktif";
                    $button = "<button type='button' class='btn btn-info tx-white' onclick='_active(\"$data->id\",\"$data->periode_nm\")'>
                               <i class='fa fa-check-following'></i>
                               </button>";
                }
                if ($data->semester_cd == 'ganjil') {
                    $semester = 'Semester Ganjil';
                } else {
                    $semester = 'Semester Genap';
                }
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='id[]' class='checkedId' value='$data->id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                 <div class='mg-l-13'>
                                 <div class='tx-inverse'><b>$data->periode_nm</b></div>
                                 <p class='mb-0 tx-13'><b>$semester</b></p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:10px;'>Status</b>$status</p>
                                 <p class='mb-0 tx-13'>Periode | " . $this->date->panjang($data->tanggal_buka) . " - " . $this->date->panjang($data->tanggal_tutup) ."</p>
                                 </div>
                                 </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$data->periode_nm\")'>
                                 <i class='icon-trash'></i> <span style='vertical-align:text-top;'>Hapus</span>
                                 </a>
                                 </nav>
                                 </div>
                                 </div>",
                );
                $ret = array('data' => $output);
            }
        } else {
            $ret = array('data' => []);
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
                <form class='form-data form-layout-1'>
                    <div class='row'>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Periode: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='periode_nm' name='periode_nm' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Semester: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='semester_cd' name='semester_cd' data-placeholder='-- Pilih Semester --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        <option value='ganjil'>Semester Ganjil</option>
                        <option value='genap'>Semester Genap</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Tanggal Buka: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='date' id='tanggal_buka' name='tanggal_buka' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Tanggal Buka: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='date' id='tanggal_tutup' name='tanggal_tutup' onchange='remove(id)'>
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
                            $('#periode_nm').removeClass('is-invalid');
                            $('#semester_cd').removeClass('is-invalid');
                            $('#tanggal_buka').removeClass('is-invalid');
                            $('#tanggal_tutup').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } else {
                $res = $this->m_periode->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1 forms'>
                        <div class='row'>
                        <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Program Studi: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='periode_nm' name='periode_nm' value='$key->periode_nm' onchange='remove(id)'>
                        </div>
                        </div>
                        <div class='col-lg-6'>
                                <div class='form-group'>
                                <label class='form-control-label tx-bold'>Periode: <span class='tx-danger'>*</span></label>
                                <select class='form-control select2' id='semester_cd' name='semester_cd' data-placeholder='-- Pilih Fakultas --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                                <option value=''></option>
                                <option value='ganjil' " . ($key->semester_cd == "ganjil" ? "selected='selected'" : "") . ">Semester Ganjil</option>
                                <option value='genap' " . ($key->semester_cd == "genap" ? "selected='selected'" : "") . ">Semester Genap</option>
                                </select>
                                </div>
                        </div>
                        <div class='col-lg-6'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Tanggal Buka: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='date' id='tanggal_buka' name='tanggal_buka' value='$key->tanggal_buka' onchange='remove(id)'>
                            </div>
                        </div>
                        <div class='col-lg-6'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Tanggal Tutup: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='date' id='tanggal_tutup' name='tanggal_tutup' value='$key->tanggal_tutup' onchange='remove(id)'>
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
                            $('#periode_nm').removeClass('is-invalid');
                            $('#semester_cd').removeClass('is-invalid');
                            $('#tanggal_buka').removeClass('is-invalid');
                            $('#tanggal_tutup').removeClass('is-invalid');
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
            $periode_nm     = $this->request->getPost('periode_nm');
            $semester_cd    = $this->request->getPost('semester_cd');
            $tanggal_buka   = $this->request->getPost('tanggal_buka');
            $tanggal_tutup  = $this->request->getPost('tanggal_tutup');
            $data = [
                'periode_nm'        => $periode_nm,
                'semester_cd'       => $semester_cd,
                'tanggal_buka'      => $tanggal_buka,
                'tanggal_tutup'     => $tanggal_tutup,
                'status'            => '1',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => session()->get('user_id'),
            ];
            $insert = $this->m_periode->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Periode Tanggal: <b class='text-danger'>$tanggal_buka</b> sudah ada, silahkan coba yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id             = $this->request->getPost('id');
            $periode_nm     = $this->request->getPost('periode_nm');
            $semester_cd    = $this->request->getPost('semester_cd');
            $tanggal_buka   = $this->request->getPost('tanggal_buka');
            $tanggal_tutup  = $this->request->getPost('tanggal_tutup');
            $data = [
                'periode_nm'    => $periode_nm,
                'semester_cd'   => $semester_cd,
                'tanggal_buka'  => $tanggal_buka,
                'tanggal_tutup' => $tanggal_tutup,
                'updated_at'    => date('Y-m-d H:i:s'),
                'updated_by'    => session()->get('user_id'),
            ];
            $update = $this->m_periode->updateData($id, $data);
            if ($update == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Periode Tanggal: <b class='text-danger'>$tanggal_buka</b> sudah ada, silahkan coba yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    // public function active()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('user_id');
    //         $data = ['status_acc' => 'active'];
    //         $this->m_pengguna->updateData($id, $data);
    //         $msg = ['sukses' => 'Aktivasi akun user telah dilakukan.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function deactive()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('user_id');
    //         $data = ['status_acc' => 'deactive'];
    //         $this->m_periode->updateData($id, $data);
    //         $msg = ['sukses' => 'Akun user telah di non-aktifkan.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = [
                'deleted_by' => session()->get('user_id'),
                'deleted_at' => date('Y-m-d H:i:s'),
                'status'      => NULL,
            ];
            $this->m_periode->updateData($id, $data);
            $msg = ['sukses' => 'Data user telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    // public function reset_password()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('user_id');
    //         $data = ['password' => sha1(md5('123456')),];
    //         $this->m_pengguna->updateData($id, $data);
    //         $msg = ['sukses' => 'Atur ulang kata sandi berhasil.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    public function multi_del()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++){
                $data = [
                    'deleted_by' => session()->get('user_id'),
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'status'      => NULL,
                ];
                $this->m_periode->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> periode telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}