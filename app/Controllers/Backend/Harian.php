<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\HarianModel;
use App\Libraries\Date\DateFunction;

class Harian extends BaseController
{
    protected $m_harian;
    protected $session;
    public function __construct()
    {
        $this->m_harian  = new HarianModel();
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
            'title'  => 'Laporan Hasil Mahasiswa',
            'active' => 'harian',
        ];
        return view('admin/harian/index', $data);
    }
    public function getData()
    {
        $user_id = session()->get('user_id');
        $res = $this->m_harian->getHarian($user_id);
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {

                if ($data->semester_cd == 'ganjil') {
                    $stat_semester_cd = 'Ganjil';
                } else {
                    $stat_semester_cd = 'Genap';
                }
                $judul = strtoupper($data->judul);
                $start_date = $this->date->panjang($data->tanggal_buka);
                $end_date = $this->date->panjang($data->tanggal_tutup);

                $pdf_foto = "<img src='" . base_url() . "/image/pdf.png' class='wd-40 ht-40 rounded-circle'>";
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                 " . $pdf_foto . "
                                 <div class='mg-l-15'>
                                 <p class='mb-0 tx-13'>
                                 <a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block'>$judul</a>
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:3px;'>Kelompok</b> <b>:</b> $data->nama
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:26px;'>Dosen</b> <b>:</b> $data->name
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:18px;'>Periode</b> <b>:</b> $data->periode_nm | $start_date s/d $end_date
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:7px;'>Semester</b> <b>:</b> $stat_semester_cd
                                 </p>
                                 </div>
                                 </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$judul\")'>
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
            $user_id = session()->get('user_id');
            $idpok = $this->m_harian->getKelompokid($user_id);
            // print_r($idpok);
            foreach ($idpok as $pok_id) {
                $iidx = $pok_id->kelompok_id;
                // print_r($iidx);
            }
            $getid_dosen_kelompok = $this->m_harian->getDosenKelompok($iidx);
            // print_r($getid_dosen_kelompok);

            foreach ($getid_dosen_kelompok as $id_dosen) {
                $nm_dosen .= "<option value='$id_dosen->user_id'>$id_dosen->name</option>";
                $nm_kelompok .= "<option value='$id_dosen->kelompok_id'>$id_dosen->nama</option>";
            }
            $id = $this->request->getPost('id');
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
                        $nm_kelompok
                        </select>
                        </div>
                    </div>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Dosen Pembimbing: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='user_id' name='user_id' data-placeholder='-- Pilih Dosen Pembimbing --' data-allow-clear='true' style='width:100%' onchange='remove(id)' disabled>
                        $nm_dosen
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-6'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Tanggal Laporan: <span class='tx-danger'>*</span></label>
                    <input type='date' name='tgl_laporan' id='tgl_laporan' class='form-control' onchange='remove(id)'>

                    </div>
                    </div>
                    </div>
                    <div class='row tx-center'>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                        <textarea rows='5' id='judul' name='judul' class='form-control' onchange='remove(id)'></textarea>
                        </div>
                    </div>
                    <div class='col-lg-6 tx-center'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>File Upload:</label>
                        <div class='fileinput fileinput-new' data-provides='fileinput'>
                            <div class='fileinput-new thumbnail' style='height:100px;'>
                            <img src='" . base_url() . "/image/pdf.png'>
                            </div>
                            <div class='fileinput-preview fileinput-exists thumbnail' style='height: 100px;line-height: 100px;'></div>
                            <div class='tx-center'>
                            <span class='btn btn-sm btn-outline-info btn-file' style='cursor:pointer;'>
                            <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                            <span class='fileinput-exists mr-1'>Change</span>
                                <input type='file' name='dokumen' id='dokumen'>
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
                            $('#judul').removeClass('is-invalid');
                            $('#tgl_laporan').removeClass('is-invalid');
                            $('#dokumen').removeClass('is-invalid');
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
            $user_id = $this->request->getPost('user_id');
            $judul = $this->request->getPost('judul');
            $dokumen    = $this->request->getFile('dokumen');
            $tgl_laporan    = $this->request->getPost('tgl_laporan');
            $path_file = $dokumen->getRandomName();
            $dokumen->move('assets-admin/panel/document/laporan_harian_mahasiswa', $path_file);

            $data = [
                'kelompok_id' => $kelompok_id,
                'user_id'     => $user_id,
                'judul'       => $judul,
                'dokumen'     => $path_file,
                'tgl_laporan'     => $tgl_laporan,
                'created_by'  => session()->get('user_id'),
                'created_at'  => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_harian->insertData($data);
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
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('id');
            $ket = $this->m_harian->getByID($id);
            $ret = "";
            $no = 1;
            foreach ($ket as $key) {

                $judul = strtoupper($key->judul);
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-body'>
                         <div class='bd rounded table-responsive table-hover tx-bold text-center' style='overflow-y:scroll;max-height:406px;padding:20px;'>$judul
                         </div>
                         <label class='form-control-label'><a class='text-center'>File Surat:</a></label>
                            <div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:500px;'>
                                <embed src='" . base_url() . "/assets-admin/panel/document/laporan_harian_mahasiswa/$key->dokumen' width='750px' height='1000px' />
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
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = [
                'deleted_by' => session()->get('user_id'),
                'deleted_at' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->m_harian->updateData($id, $data);
            $msg = ['sukses' => 'Data laporan harian telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}
