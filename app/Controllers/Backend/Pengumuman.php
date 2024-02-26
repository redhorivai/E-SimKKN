<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\PengumumanModel;
use App\Libraries\Date\DateFunction;

class Pengumuman extends BaseController
{
    protected $m_pengumuman;
    protected $session;
    public function __construct()
    {
        $this->m_pengumuman  = new PengumumanModel();
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
            'title'  => 'Pengumuman',
            'active' => 'pengumuman',
        ];
        return view('admin/pengumuman/index', $data);
    }
    public function getData()
    {
        $res = $this->m_pengumuman->getPengumuman();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='id[]' class='checkedId' value='$data->id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                <div class='mg-l-15'>
                                <a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block'>$data->judul</a>
                                <span class='tx-13'>".$this->date->panjang($data->created_dttm)."</span>
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
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$data->judul\")'>
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
                        <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='judul' name='judul' onchange='remove(id)'>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Isi/Keterangan: <span class='tx-danger'>*</span></label>
                        <textarea rows='5' id='keterangan' name='keterangan' class='form-control' onchange='remove(id)'></textarea>
                        </div>
                    </div>
                    </div>
                    <div class='row tx-center'>
                    <div class='col-lg-12 tx-center'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>File Upload:</label>
                        <div class='fileinput fileinput-new' data-provides='fileinput'>
                            <div class='fileinput-new thumbnail' style='height:100px;'>
                            <img src='".base_url()."/image/pdf.png'>
                            </div>
                            <div class='fileinput-preview fileinput-exists thumbnail' style='height: 100px;line-height: 100px;'></div>
                            <div class='tx-center'>
                            <span class='btn btn-sm btn-outline-info btn-file' style='cursor:pointer;'>
                            <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                            <span class='fileinput-exists mr-1'>Change</span>
                                <input type='file' name='path' id='path'>
                            </span>
                            <a href='#' class='btn btn-sm btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;'>Remove</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class='row tx-center'>";
                    $ret .= "</div>
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
                            $('#judul').removeClass('is-invalid');
                            $('#keterangan').removeClass('is-invalid');
                            $('#path').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } 
            else {
                $res = $this->m_pengumuman->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1 forms'>
                    <input type='hidden' name='path_lama' id='path_lama' value='$key->path'>
                        <div class='row'>
                        <div class='col-lg-6'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='judul' name='judul' value='$key->judul' onchange='remove(id)'>
                            </div>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Isi/Deskripsi: <span class='tx-danger'>*</span></label>
                            <textarea rows='5' id='keterangan' name='keterangan' class='form-control'>".$key->keterangan."</textarea>
                            </div>
                        </div>
                        </div>
                        <div class='row tx-center'>
                        <div class='col-lg-12 tx-center'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>File Upload:</label>
                            <div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:500px;'>
                                <embed src='".base_url()."/assets-admin/panel/document/$key->path' width='950px' height='2100px' />
                                </div>
                                <div class='fileinput-preview fileinput-exists thumbnail' style='height:175px;'></div>
                                <div class='tx-center'>
                                <span class='btn btn-sm btn-outline-info btn-file' style='cursor:pointer;'>
                                <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                                <span class='fileinput-exists mr-1'>Change</span>
                                  <input type='file' name='path' id='path'>
                                </span>
                                <a href='#' class='btn btn-sm btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;'>Remove</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class='row tx-center'>";
                    $ret .= "</div>
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
                                $('#judul').removeClass('is-invalid');
                                $('#keterangan').removeClass('is-invalid');
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
            $judul       = ucwords($this->request->getPost('judul'));
            $keterangan = $this->request->getPost('keterangan');
            $path    = $this->request->getFile('path');
            $path_file = $path->getRandomName();
            $path->move('assets-admin/panel/document', $path_file); 

            $data = [
                'judul'        => ucwords($judul),
                'keterangan'   => $keterangan,
                'path'         => $path_file,
                'status_cd'    => 'normal',
                'created_user' => session()->get('user_id'),
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_pengumuman->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Judul: <b class='text-danger'>$judul</b> sudah ada, silahkan coba yang lain.";
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
            $id          = $this->request->getPost('id');
            $judul       = ucwords($this->request->getPost('judul'));
            $keterangan = $this->request->getPost('keterangan');
            $path    = $this->request->getFile('path');
            $path_lama  = $this->request->getVar('path_lama');
            
            if ($path == null) {
                $path_file = $path_lama;
            } else {
                $path_file = $path->getRandomName();
                $path->move('assets-admin/panel/document', $path_file);
                // if ($path_lama != $path ) {
                //     unlink('assets-admin/panel/document', $path_lama);
                // }
            }
            
            $data = [
                'judul'        => ucwords($judul),
                'keterangan'   => $keterangan,
                'path'         => $path_file,
                'status_cd'    => 'normal',
                'updated_user' => session()->get('user_id'),
                'updated_dttm' => date('Y-m-d H:i:s'),
            ];
            $update = $this->m_pengumuman->updateData($id, $data);
            if ($update == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Judul: <b class='text-danger'>$judul</b> sudah ada, silahkan coba yang lain.";
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
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->m_pengumuman->updateData($id, $data);
            $msg = ['sukses' => 'Pengumuman telah dihapus.'];
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
                    'nullified_user' => session()->get('user_id'),
                    'nullified_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'      => 'nullified',
                ];
                $this->m_pengumuman->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> pengumuman telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    // public function detail()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id      = $this->request->getPost('artikel_id');
    //         $artikel = $this->m_artikel->getByID($id);

    //         $ret = "";
    //         $no = 1;
    //         foreach ($artikel as $key) {
    //             $ret .= "<div class='modal-dialog modal-lg' role='document'>
    //                      <div class='modal-content'>
    //                      <div class='modal-header'>
    //                      <h5 class='text-center text-dark w-100'><b>".$key->title."</b><br><small class='w-100' style='font-size:12px;color:#888;'>Admin | ".$this->date->panjang($key->created_dttm)."</small></h5>
    //                      </div>
    //                      <div class='modal-body'>
    //                      <div class='bd rounded table-responsive table-hover' style='overflow-y:scroll;max-height:406px;padding:20px;'>
    //                      ".$key->description."
    //                      </div>
    //                      </div>
    //                      <div class='modal-footer'>
    //                      <button type='button' class='btn btn-block btn-light' data-dismiss='modal' style='font-size:11px;'>Tutup
    //                      </button>
    //                      </div>
    //                      </div>
    //                      </div>";
    //         }
    //         return $ret;
    //     } else {
    //         exit('Request Error');
    //     }
    // }
}