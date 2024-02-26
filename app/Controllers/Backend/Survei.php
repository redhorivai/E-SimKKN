<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\SurveiModel;
use App\Libraries\Date\DateFunction;

class Survei extends BaseController
{
    protected $m_survei;
    protected $session;
    public function __construct()
    {
        $this->m_survei  = new SurveiModel();
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
            'title'  => 'Laporan Hasil Survei',
            'active' => 'survei',
        ];
        return view('admin/survei/index', $data);
    }
    public function getData()
    {
        $user_id = session()->get('user_id');
        $res = $this->m_survei->getSurvei($user_id);
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {

                if ($data->status == '') {
                    $stat = "<u style='color:#f69a05'><i> belum ditindaklanjuti</i></u> <span class='square-8 bg-warning rounded-circle'></span>";
                    $ket = $data->keterangan;
                } elseif ($data->status == 'diterima') {
                    $stat = "<u style='color:#2aa623'><i> diterima</i></u> <span class='square-8 bg-success rounded-circle'></span>";
                    $ket = $data->keterangan;
                } else {
                    $stat = "<u style='color:#d80b0b'><i> ditolak</i></u> <span class='square-8 bg-danger rounded-circle'></span>";
                    $ket = "<del>$data->keterangan</del>";
                }
                if ($data->semester_cd == 'ganjil') {
                    $stat_semester_cd = 'Ganjil';
                } else {
                    $stat_semester_cd = 'Genap';
                }
                $ket_1 = strtoupper($ket);
                $start_date = $this->date->panjang($data->tanggal_buka);
                $end_date = $this->date->panjang($data->tanggal_tutup);

                $pdf_foto = "<img src='".base_url()."/image/pdf.png' class='wd-40 ht-40 rounded-circle'>";
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                 ".$pdf_foto."
                                 <div class='mg-l-15'>
                                 <p class='mb-0 tx-13'>
                                 <a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block'>$ket_1</a>
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:3px;'>Kelompok</b> <b>:</b> $data->nama
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:18px;'>Periode</b> <b>:</b> $data->periode_nm | $start_date s/d $end_date
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:7px;'>Semester</b> <b>:</b> $stat_semester_cd
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:26px;'>Status</b> <b>:</b> $stat
                                 </p>
                                 </div>
                                 </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 
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
            $user_id = session()->get('user_id');
            $idpok = $this->m_survei->getKelompokByID($user_id);
            // print_r($idpok);
            foreach ($idpok as $pok_id) {
                $iidx = $pok_id->kelompok_id;
            // print_r($iidx);
            }
            $getid_dosen_kelompok = $this->m_survei->getDosenKelompok($iidx);
            // print_r($getid_dosen_kelompok);

            foreach ($getid_dosen_kelompok as $id_dosen) {
                $opt_kelompok .= "<option value='$id_dosen->kelompok_id'>$id_dosen->nama</option>";
                $opt_dosen .= "<option value='$id_dosen->user_id'>$id_dosen->name</option>";
            }
            if ($id == "") {
                
                $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Tambah Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                csrf_field();
                
                $ret .= "
                <form class='form-data form-layout-1 forms'>
                    <div class='row'>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Kelompok: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='kelompok_id' name='kelompok_id' data-placeholder='-- Pilih Kelompok --' data-allow-clear='true' style='width:100%' onchange='remove(id)' disabled>
                        $opt_kelompok
                        </select>
                        </div>
                    </div>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Dosen Pembimbing: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='user_id' name='user_id' data-placeholder='-- Pilih Dosen Pembimbing --' data-allow-clear='true' style='width:100%' onchange='remove(id)' disabled>
                        $opt_dosen
                        </select>
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
                            $('#kelompok_id').removeClass('is-invalid');
                            $('#user_id').removeClass('is-invalid');
                            $('#path').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } 
            else {
                $get_periode_id = $this->m_laporandpl->getPeriode_id();
                foreach ($get_periode_id as $key1) {
                if ($key1->semester_cd == 'ganjil') {
                    $res_semester_cd = 'Semester Ganjil';
                } else {
                    $res_semester_cd = 'Semester Genap';
                }
                $opt_id .= "<option " . ($key1->id == "$key1->id" ? "selected='selected'" : "") . "  value='$key1->id'>$key1->periode_nm ($res_semester_cd)</option>";
                }
                $res = $this->m_laporandpl->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1 forms'>
                    <input type='text' name='path_lama' id='path_lama' value='$key->path'>
                    <input type='hidden' name='id' value='$key->id'>
                        <div class='row'>
                        <div class='col-lg-6'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Surat Tugas: <span class='tx-danger'>*</span></label>
                            <select class='form-control select2' id='type' name='type' data-placeholder='-- Pilih Jenis Surat --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            <option " . ($key->type == "survei" ? "selected='selected'" : "") . " value='survei'>Surat Perintah Tugas Survei Lapangan</option>
                            <option " . ($key->type == "antar" ? "selected='selected'" : "") . " value='antar'>Surat Perintah Tugas Pengantaran Lapangan</option>=
                            <option " . ($key->type == "supervisi" ? "selected='selected'" : "") . " value='supervisi'>Surat Perintah Tugas Supervisi Lapangan</option>
                            <option " . ($key->type == "jemput" ? "selected='selected'" : "") . " value='jemput'>Surat Perintah Tugas Penjemputan Lapangan</option>
                            </select>
                            </div>
                        </div>
                        <div class='col-lg-6'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Surat Tugas: <span class='tx-danger'>*</span></label>
                            <select class='form-control select2' id='periode_id' name='periode_id' data-placeholder='-- Pilih Jenis Periode --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            <option " . ($key1->id == "$key1->id" ? "selected='selected'" : "") . "  value='$key1->id'>$key1->periode_nm ($res_semester_cd)</option>
                            </select>
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
                                <embed src='".base_url()."/assets-admin/panel/document/laporan_dpl/$key->path' width='950px' height='2100px' />
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
                                $('#type').removeClass('is-invalid');
                                $('#periode_id').removeClass('is-invalid');
                                $('#keterangan').removeClass('is-invalid');
                                $('#path').removeClass('is-invalid');
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
            $kelompok_id = $this->request->getPost('kelompok_id');
            $user_id = $this->request->getPost('user_id');
            $path    = $this->request->getFile('path');
            $path_file = $path->getRandomName();
            $path->move('assets-admin/panel/document/laporan_survei_mahasiswa', $path_file); 

            $data = [
                'kelompok_id'        => $kelompok_id,
                'user_id'   => $user_id,
                'path'         => $path_file,
                'created_by' => session()->get('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_survei->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Judul: <b class='text-danger'>$kelompok_id</b> sudah ada, silahkan coba yang lain.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
    // public function update_data()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id          = $this->request->getPost('id');
    //         $judul       = ucwords($this->request->getPost('judul'));
    //         $keterangan = $this->request->getPost('keterangan');
    //         $path    = $this->request->getFile('path');
    //         $path_lama  = $this->request->getVar('path_lama');
            
    //         if ($path == null) {
    //             $path_file = $path_lama;
    //         } else {
    //             $path_file = $path->getRandomName();
    //             $path->move('assets-admin/panel/document', $path_file);
    //             // if ($path_lama != $path ) {
    //             //     unlink('assets-admin/panel/document', $path_lama);
    //             // }
    //         }
            
    //         $data = [
    //             'judul'        => ucwords($judul),
    //             'keterangan'   => $keterangan,
    //             'path'         => $path_file,
    //             'status_cd'    => 'normal',
    //             'updated_user' => session()->get('user_id'),
    //             'updated_dttm' => date('Y-m-d H:i:s'),
    //         ];
    //         $update = $this->m_pengumuman->updateData($id, $data);
    //         if ($update == true) {    
    //             $msg = "Sukses";
    //         } else {
    //             $msg = "Judul: <b class='text-danger'>$judul</b> sudah ada, silahkan coba yang lain.";
    //         }
    //     } else {
    //         $msg = [
    //             "error" => "Request Error",
    //         ];
    //     }
    //     echo json_encode($msg);
    // }
    // public function del_data()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('id');
    //         $data = [
    //             'deleted_by' => session()->get('user_id'),
    //             'deleted_at' => date('Y-m-d H:i:s'),
    //             'status_cd'      => 'nullified',
    //         ];
    //         $this->m_survei->updateData($id, $data);
    //         $msg = ['sukses' => 'Surat Tugas telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function multi_del()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('id');
    //         $jmldata = count($id);
    //         for ($i = 0; $i < $jmldata; $i++){
    //             $data = [
    //             'deleted_by' => session()->get('user_id'),
    //             'deleted_at' => date('Y-m-d H:i:s'),
    //             'status_cd'      => 'nullified',
    //             ];
    //             $this->m_survei->updateData($id[$i], $data);
    //         }
    //         $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> surat tugas telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('id');
            $ket = $this->m_survei->getByID($id);
            $ret = "";
            $no = 1;
            foreach ($ket as $key) {
                if ($key->type == 'survei') {
                    $type_dpl = 'Surat Perintah Tugas Survei Lapangan';
                } elseif ($key->type == 'antar') {
                    $type_dpl = 'Surat Perintah Tugas Pengantaran Lapangan';
                } elseif ($key->type == 'supervisi') {
                    $type_dpl = 'Surat Perintah Tugas Supervisi Lapangan';
                } else {
                    $type_dpl = 'Surat Perintah Tugas Penjemputan Lapangan';
                }

                $ket1 = strtoupper($key->keterangan);
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-header'>
                         <h5 class='text-center text-dark w-100'><b>$type_dpl</b><br><small class='w-100' style='font-size:12px;color:#888;'>Admin | ".$this->date->panjang($key->created_dttm)."</small></h5>
                         </div>
                         <div class='modal-body'>
                         <div class='bd rounded table-responsive table-hover tx-bold text-center' style='overflow-y:scroll;max-height:406px;padding:20px;'>$ket1
                         </div>
                         <label class='form-control-label'><a class='text-center'>File Surat:</a></label>
                            <div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:500px;'>
                                <embed src='".base_url()."/assets-admin/panel/document/laporan_survei_mahasiswa/$key->path' width='750px' height='1000px' />
                                </div>
                            </div>
                         </div>
                         <div class='modal-footer'>
                         <button type='button' class='btn btn-block btn-light' data-dismiss='modal' style='font-size:11px;'>Tutup
                         </button>
                         </div>
                         </div>
                         </div>";
            }
            return $ret;
        } else {
            exit('Request Error');
        }
    }
}